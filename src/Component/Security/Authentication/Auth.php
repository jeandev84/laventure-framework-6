<?php
namespace Laventure\Component\Security\Authentication;


use Laventure\Component\Security\Authentication\User\UserStorageInterface;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserPasswordEncoderInterface;
use Laventure\Component\Security\User\UserProviderInterface;

/**
 * @AuthenticationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authorization
*/
class Auth implements AuthenticationInterface
{

    /**
     * @var UserProviderInterface
    */
    protected $provider;




    /**
     * @var UserPasswordEncoderInterface
    */
    protected $encoder;




    /**
     * @var UserStorageInterface
    */
    protected $storage;





    /**
     * @param UserProviderInterface $provider
     *
     * @param UserPasswordEncoderInterface $encoder
     *
     * @param UserStorageInterface $storage
    */
    public function __construct(UserProviderInterface $provider, UserPasswordEncoderInterface $encoder, UserStorageInterface $storage)
    {
         $this->provider = $provider;
         $this->encoder  = $encoder;
         $this->storage  = $storage;
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
         if ($this->encoder->needsRehash($user)) {

         }

         // save user in session
         $this->storage->setUserSession($user);


         // save remember token if user has been remembered
         if ($rememberMe) {
             $this->storage->setRememberToken($user);
         }

         return true;
    }





    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
        return $this->storage->getUser();
    }





    /**
     * @inheritDoc
    */
    public function logout(): bool
    {
        return $this->storage->clearUserSession();
    }
}