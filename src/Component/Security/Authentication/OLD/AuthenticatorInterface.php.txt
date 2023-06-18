<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\User\UserCredentialsInterface;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserTokenInterface;

interface AuthenticatorInterface
{

    /**
     * @param UserCredentialsInterface $credentials
     *
     * @return bool
    */
    public function authenticate(UserCredentialsInterface $credentials): bool;



    /**
     * @param UserInterface $user
     *
     * @return mixed
    */
    public function setUserToken(UserInterface $user);



    /**
     * @return UserTokenInterface
    */
    public function getToken(): UserTokenInterface;





    /**
     * @return bool
    */
    public function logout(): bool;
}