<?php
namespace Laventure\Component\Security\Authentication;


use Laventure\Component\Security\User\UserCredentials;
use Laventure\Component\Security\User\UserInterface;

/**
 * @AuthenticationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authorization
*/
class Auth
{

    /**
     * @var AuthenticatorInterface
    */
    protected AuthenticatorInterface $authenticator;


    /**
     * @param AuthenticatorInterface $authenticator
    */
    public function __construct(AuthenticatorInterface $authenticator)
    {
        $this->authenticator = $authenticator;
    }





    /**
     * @param string $username
     *
     * @param string $password
     *
     * @param bool $rememberMe
     *
     * @return bool
    */
    public function attempt(string $username, string $password, bool $rememberMe = false): bool
    {
         return $this->authenticator->authenticate(new UserCredentials($username, $password, $rememberMe));
    }





    /**
     * @return UserInterface
    */
    public function getUser(): UserInterface
    {
        return $this->authenticator->getToken()->getUser();
    }





    /**
     * @return bool
    */
    public function logout(): bool
    {
        return $this->authenticator->logout();
    }
}