<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;

class RegistrationController extends AbstractController {
    private $passwordEncoder;

    private $session;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, SessionInterface $session) {
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }


    /**
     * @Route("/register/{key}", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, $key = false): Response
    {
        $user = new User();

        if(false !== $key && $request->getMethod() == 'GET') {
            $user = $this->getUserFromResourceOwner($request, $key);
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * Get a resource owner by name.
     *
     * @param string $name
     *
     * @return ResourceOwnerInterface
     *
     * @throws NotFoundHttpException if there is no resource owner with the given name
     */
    protected function getResourceOwnerByName($name)
    {
        foreach ($this->getParameter('hwi_oauth.firewall_names') as $firewall) {
            $id = 'hwi_oauth.resource_ownermap.'.$firewall;

            if (!$this->container->has($id)) {
                continue;
            }

            $ownerMap = $this->container->get($id);
            if ($resourceOwner = $ownerMap->getResourceOwnerByName($name)) {
                return $resourceOwner;
            }
        }

        throw new NotFoundHttpException(sprintf("No resource owner with name '%s'.", $name));
    }

    /**
     *
     * @param Request $request
     * @param string $key
     * @return User
     * @throws \RuntimeException
     */
    private function getUserFromResourceOwner(Request $request, string $key) : User
    {
        $session = $request->getSession();
        if (!$session->isStarted()) {
            $session->start();
        }

        $error = $session->get('_hwi_oauth.registration_error.'.$key);
        $session->remove('_hwi_oauth.registration_error.'.$key);

        if (!$error instanceof AccountNotLinkedException) {
            throw new \RuntimeException('Cannot register an account.', 0, $error instanceof \Exception ? $error : null);
        }

        $setter = 'set'.ucfirst($error->getResourceOwnerName()).'Id';

        $user = new User();

        $user->setEmail($this->session->get('emailFromResource'));
        $user->setFullname($this->session->get('usernameFromResource'));

        return $user;
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request) {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Set their role
            $user->setRoles(['ROLE_USER']);

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
