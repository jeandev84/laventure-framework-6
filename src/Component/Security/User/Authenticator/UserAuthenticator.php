<?php
namespace Laventure\Component\Security\Authenticator;

use Laventure\Component\Security\Authentication\Authenticator;
use Laventure\Component\Security\User\Encoder\Password\UserPasswordEncoder;
use Laventure\Component\Security\User\Provider\UserProviderInterface;
use Laventure\Component\Security\User\Token\UserTokenInterface;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserPasswordEncoderInterface;


/**
 * @UserAuthenticator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Authentication
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
     * @param UserPasswordEncoderInterface $encoder
    */
    public function __construct(UserProviderInterface $provider, UserPasswordEncoderInterface $encoder)
    {
        $this->provider = $provider;
        $this->encoder  = $encoder;
    }




    /**
     * @inheritDoc
    */
    public function attempt(string $username, string $password, bool $rememberMe = false): bool
    {
            // check if user by username
            $user = $this->provider->findByUsername($username);

            // if not user and has not valid credentials
            if(! $user || ! $this->isPasswordValid($user, $password)) {
                 return false;
            }

            // rehash user password
            $user = $this->rehashUserPassword($user, $password);


            // save user
            $this->createToken($user);


            // set remember me cookie
            if ($rememberMe) {
                $this->createRememberToken($user);
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
        if (! $this->provider->hasToken()) {
            return false;
        }

        return $this->provider->removeToken($this->getUser());
    }





    /**
     * @param UserInterface $user
     *
     * @param string $plainPassword
     *
     * @return bool
    */
    private function isPasswordValid(UserInterface $user, string $plainPassword): bool
    {
        return $this->encoder->isPasswordValid($user, $plainPassword);
    }





    /**
     * @param UserInterface $user
     *
     * @param string $plainPassword
     *
     * @return UserInterface
    */
    private function rehashUserPassword(UserInterface $user, string $plainPassword): UserInterface
    {
        $rehashPassword = $this->encoder->encodePassword($user, $plainPassword);

        if ($this->encoder->needsRehash($user)) {
            $this->provider->updatePasswordHash($user, $rehashPassword);
        }

        return $user;
    }





    /**
     * @param UserInterface $user
     *
     * @return UserTokenInterface
    */
    private function createToken(UserInterface $user): UserTokenInterface
    {
        // save user in session
        return $this->provider->createToken($user);
    }





    /**
     * @param UserInterface $user
     *
     * @return UserInterface
    */
    private function createRememberToken(UserInterface $user): UserInterface
    {
        if (! $this->provider->hasRememberToken()) {
             return $user;
        }
        
        return $this->provider->createRememberToken($user);
    }
}