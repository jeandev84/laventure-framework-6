<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\User\UserInterface;

interface AuthenticatorInterface
{

    /**
     * @return array
    */
    public function getCredentials(): array;



    /**
     * @return bool
    */
    public function authenticate(): bool;




    /**
     * @return UserInterface
    */
    public function getUser(): UserInterface;
}