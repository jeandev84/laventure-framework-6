<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\User\Password\UserPasswordEncoder;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserPasswordEncoderInterface;
use Laventure\Component\Security\User\UserProviderInterface;



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
        $user = $this->provider->findByUsername($username);

        // if not user and has not valid credentials
        if(! $user || ! $this->encoder->isPasswordValid($user, $password)) {
            return false;
        }


        // rehash user password
        $rehashPassword = $this->encoder->encodePassword($user, $password);

        if ($this->encoder->needsRehash($user)) {
            $this->provider->updateUserPasswordHash($user, $rehashPassword);
        }
        
        // save user in session
        $this->provider->createToken($user);


        // save remember token if user has been remembered
        if ($rememberMe) {
            $this->provider->createRememberToken($user);
        }

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
}