<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileController extends AbstractController {
    /** @var EntityManagerInterface */
    private $entityManager;

    private $passwordEncoder;

    /** @var \App\Repository\OrderRepository */
    private $orderRepository;

    /** @var \App\Repository\OfficeRepository */
    private $officeRepository;
    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager) {
        $this->passwordEncoder = $passwordEncoder;
        $this->orderRepository = $entityManager->getRepository('App:Order');
        $this->officeRepository = $entityManager->getRepository('App:Office');
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request) {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect('/');
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/offices-for-renting", name="my-offices-for-renting")
     */
    public function officesForRenting(Request $request) {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profile/offices_for_renting.html.twig', [
            'offices' => $this->officeRepository->findAllByOwner($this->getUser()->getId()),
            'orders' => $this->orderRepository->findAllByBookedUser($this->getUser()->getId()),
        ]);
    }
}
