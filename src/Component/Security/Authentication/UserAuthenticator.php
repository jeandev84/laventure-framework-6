<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\Authentication\Exception\UserBadCredentialsException;
use Laventure\Component\Security\User\Password\UserPasswordEncoder;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserPasswordEncoderInterface;
use Laventure\Component\Security\User\UserProviderInterface;
use Laventure\Component\Security\User\UserTokenInterface;


/**
 * @UserAuthenticator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authentication
*/
class UserAuthenticator extends Authenticator
{

    /**
     * @var UserProviderInterface
    */
    protected UserProviderInterface $provider;



    /**
     * @var UserPasswordEncoderInterface
    */
    protected UserPasswordEncoderInterface $encoder;



    /**
     * @param UserProviderInterface $provider
     *
     * @param UserPasswordEncoderInterface|null $encoder
    */
    public function __construct(UserProviderInterface $provider, UserPasswordEncoderInterface $encoder = null)
    {
        $this->provider = $provider;
        $this->encoder  = $encoder ?: new UserPasswordEncoder();
    }




    /**
     * @inheritDoc
    */
    public function attempt(string $username, string $password, bool $rememberMe = false): bool
    {
        // check if user by username
        $user = $this->checkUser($username);

        // if not user and has not valid credentials
        if(! $user || ! $this->isPasswordValid($user, $password)) {
             return false;
        }

        // rehash user password
        $user = $this->rehashUserPassword($user, $password);


        // save user
        $this->createUserToken($user, $rememberMe);

        return true;
    }

    



    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
        return $this->provider->getToken()->getUser();
    }




    /**
     * @inheritDoc
    */
    public function logout(): bool
    {
        return $this->provider->removeToken($this->getUser());
    }





    /**
     * @inheritDoc
    */
    public function isPasswordValid(UserInterface $user, string $plainPassword): bool
    {
        return $this->encoder->isPasswordValid($user, $plainPassword);
    }




    /**
     * @inheritdoc
    */
    public function rehashUserPassword(UserInterface $user, string $plainPassword): UserInterface
    {
        $rehashPassword = $this->encoder->encodePassword($user, $plainPassword);

        if ($this->encoder->needsRehash($user)) {
            $this->provider->updateUserPasswordHash($user, $rehashPassword);
        }

        return $user;
    }




    /**
     * @inheritDoc
    */
    public function checkUser(string $username): UserInterface|false
    {
        // check if user by username
        return $this->provider->findByUsername($username);
    }




    /**
     * @inheritDoc
    */
    public function createUserToken(UserInterface $user, bool $rememberMe = false): UserTokenInterface
    {
        // save user in session
        $this->provider->createToken($user);

        // save remember token if user has been remembered
        if ($rememberMe) {
            $this->provider->createRememberToken($user);
        }

        return $this->provider->getToken();
    }
}