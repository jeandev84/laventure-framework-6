<?php
namespace Laventure\Foundation\Authentication;

use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Security\Authentication\AuthenticatorInterface;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserTokenInterface;

abstract class Authenticator implements AuthenticatorInterface
{


    /**
     * @param Request $request
     *
     * @return UserInterface
    */
    abstract public function authenticate(Request $request): UserInterface;



    /**
     * @inheritDoc
    */
    public function rememberMe(): bool
    {
        // TODO: Implement rememberMe() method.
    }



    /**
     * @inheritDoc
    */
    public function setUserToken(UserInterface $user)
    {
        // TODO: Implement setUserToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getToken(): UserTokenInterface
    {
        // TODO: Implement getToken() method.
    }
}