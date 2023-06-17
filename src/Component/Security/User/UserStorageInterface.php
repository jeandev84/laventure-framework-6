<?php
namespace Laventure\Component\Security\Authentication\User;

use Laventure\Component\Security\User\UserInterface;


/**
 * @UserStorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authentication\User
*/
interface UserStorageInterface
{

      /**
       * Save user in session
       *
       * @param UserInterface $user
       *
       * @return static
      */
      public function setUserSession(UserInterface $user): static;




      /**
       * @param UserInterface $user
       *
       * @return $this
      */
      public function setRememberToken(UserInterface $user): static;






      /**
       * Returns user from the session
       *
       * @return UserInterface
      */
      public function getUser(): UserInterface;







      /**
       * @return mixed
      */
      public function clearUserSession();
}