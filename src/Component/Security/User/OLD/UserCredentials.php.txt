<?php
namespace Laventure\Component\Security\User;

class UserCredentials implements UserCredentialsInterface
{

    /**
     * @param string $username
     *
     * @param string $password
     *
     * @param bool $rememberMe
    */
    public function __construct(protected string $username, protected string $password, protected bool $rememberMe = false)
    {
    }



    /**
     * @inheritDoc
    */
    public function getUsername(): string
    {
        return $this->username;
    }



    /**
     * @inheritDoc
    */
    public function getPlainPassword(): string
    {
        return $this->password;
    }





    /**
     * @inheritDoc
    */
    public function getRememberMe(): bool
    {
        return $this->rememberMe;
    }
}