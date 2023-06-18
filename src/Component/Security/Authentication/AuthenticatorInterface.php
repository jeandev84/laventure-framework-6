<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserTokenInterface;

interface AuthenticatorInterface
{

      /**
       * @return bool
      */
      public function rememberMe(): bool;



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
}