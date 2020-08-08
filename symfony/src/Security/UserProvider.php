<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;

class UserProvider implements UserProviderInterface, OAuthAwareUserProviderInterface
{
    private $em;
    private $property = 'email';
    private $session;

    public function __construct(EntityManagerInterface $em, SessionInterface $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * Symfony calls this method if you use features like switch_user
     * or remember_me.
     *
     * If you're not using these features, you do not need to implement
     * this method.
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        $repository = $this->em->getRepository(User::class);

        if (null !== $this->property) {
            $user = $repository->findOneBy([$this->property => $username]);
        } else {
            if (!$repository instanceof UserLoaderInterface) {
                throw new \InvalidArgumentException(sprintf('You must either make the "%s" entity Doctrine Repository ("%s") implement "Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface" or set the "property" option in the corresponding entity provider configuration.', $this->classOrAlias, \get_class($repository)));
            }
            $user = $repository->loadUserByUsername($username);
        }

        if (null === $user) {
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }

        return $user;
    }

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     *
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     *
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', User::class));
        }

        $repository = $this->em->getRepository(User::class);

        if ($repository instanceof UserProviderInterface) {
            $refreshedUser = $repository->refreshUser($user);
        } else {
            $refreshedUser = $repository->find($user->getId());
            if (null === $refreshedUser) {
                throw new UsernameNotFoundException(sprintf('User with id %s not found', json_encode($user->getId())));
            }
        }

        return $refreshedUser;
    }


    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }

    /**
     * Loads the user by a given UserResponseInterface object.
     *
     * @param UserResponseInterface $response
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $repository = $this->em->getRepository(User::class);
        $username = $response->getUsername();

        if (null === $username) {
            throw new AccountNotLinkedException("Username is empty.");
        }

        $user = $repository->findOneBy(array($this->getResourceOnwerPropertyName($response) => $username));

        if (null === $user) {

            // now that we did not find a user on the id of the service we will try to find the email of the user
            $user = $repository->findOneBy(array('email' => $response->getEmail()));

            if (null === $user) {
                $this->session->set('emailFromResource', $response->getEmail());
                $this->session->set('usernameFromResource', $response->getRealName());
                throw new AccountNotLinkedException(sprintf("User '%s' not found.", $response->getEmail())); // redirects to registration form
            }

            // connect user
            $this->setIdForResourceOwner($user, $response);

            $this->em->flush();
        }

        return $user;
    }

    /**
     * Sets facebookId or googleId etc in the User entity.
     * Requires that your User entity has an Id field for every resourceOwner that you use.
     *
     * @param UserInterface $user
     * @param UserResponseInterface $response
     */
    private function setIdForResourceOwner(UserInterface $user, UserResponseInterface $response)
    {
        $service = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($service) . 'Id';
        $user->$setter($response->getUsername());
    }

    /**
     * @param UserResponseInterface $response
     *
     * @return string with the name of the property that can be accessed in the User entity e.g. facebookId or googleId
     */
    private function getResourceOnwerPropertyName(UserResponseInterface $response): string
    {
        return $response->getResourceOwner()->getName() . 'Id';
    }

}