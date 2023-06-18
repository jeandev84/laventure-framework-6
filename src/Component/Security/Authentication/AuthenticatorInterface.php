<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserTokenInterface;


interface AuthenticatorInterface
{

       /**
        * Login in user
        *
        * @param string $username
        *
        * @param string $password
        *
        * @param bool $rememberMe
        *
        * @return bool
      */
      public function attempt(string $username, string $password, bool $rememberMe = false): bool;





      /**
       * @return UserInterface
      */
      public function getUser(): UserInterface;





      /**
       * Logout user
       *
       * @return bool
      */
      public function logout(): bool;
}