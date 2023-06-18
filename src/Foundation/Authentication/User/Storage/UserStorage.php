<?php

namespace Laventure\Foundation\Authentication\User\Storage;

use Laventure\Component\Http\Storage\Session\Session;
use Laventure\Component\Http\Storage\Session\SessionInterface;
use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserProviderInterface;
use Laventure\Component\Security\User\UserStorageInterface;
use Laventure\Component\Security\User\UserToken;
use Laventure\Component\Security\User\UserTokenInterface;

class UserStorage implements UserStorageInterface
{


    protected Session $session;


    public function __construct()
    {
        $this->session = new Session();
    }



    /**
     * @inheritDoc
     */
    public function hasUserToken(): bool
    {
         return $this->session->has(UserTokenInterface::TOKEN_KEY);
    }



    /**
     * @inheritDoc
     */
    public function getToken(): UserTokenInterface
    {
        return unserialize($this->session->get(UserTokenInterface::TOKEN_KEY));
    }




    /**
     * @inheritDoc
     */
    public function setUserSession(UserInterface $user): static
    {
        $userToken = new UserToken($user);

        $this->session->set(UserTokenInterface::TOKEN_KEY, $userToken->serialize());

        return $this;
    }



    /**
     * @inheritDoc
     */
    public function setRememberToken(UserProviderInterface $provider): static
    {
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function removeUserSession(UserProviderInterface $provider): bool
    {
        return true;
    }
}