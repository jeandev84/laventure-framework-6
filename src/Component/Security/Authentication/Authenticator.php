<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\Authentication\User\UserStorageInterface;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserPasswordEncoderInterface;
use Laventure\Component\Security\User\UserProviderInterface;

abstract class Authenticator implements AuthenticatorInterface
{


    /**
     * @var UserProviderInterface
     */
    protected $userProvider;




    /**
     * @var UserPasswordEncoderInterface
     */
    protected $userPasswordEncoder;




    /**
     * @var UserStorageInterface
    */
    protected $userStorage;




    /**
     * @param UserProviderInterface $userProvider
     *
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     *
     * @param UserStorageInterface $userTokenStorage
    */
    public function __construct(UserProviderInterface $userProvider, UserPasswordEncoderInterface $userPasswordEncoder, UserStorageInterface $userTokenStorage)
    {
        $this->userProvider        = $userProvider;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->userStorage         = $userTokenStorage;
    }






    /**
     * @inheritDoc
    */
    public function authenticate(): bool
    {
        // TODO: Implement authenticate() method.
    }




    /**
     * @inheritDoc
    */
    public function getUser(): UserInterface
    {
        // TODO: Implement getUser() method.
    }





    /**
     * @inheritDoc
    */
    abstract public function getCredentials(): array;
}