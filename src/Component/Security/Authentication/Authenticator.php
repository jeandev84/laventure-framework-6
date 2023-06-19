<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\User\Token\UserTokenInterface;
use Laventure\Component\Security\User\UserInterface;


/**
 * @Authenticator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authenticator
*/
abstract class Authenticator implements AuthenticatorInterface
{

      /**
       * @param string $username
       *
       * @return UserInterface|false
      */
      abstract public function checkUser(string $username): UserInterface|false;




      /**
       * Determine if user plain password is valid
       *
       * @param UserInterface $user
       *
       * @param string $plainPassword
       *
       * @return bool
      */
      abstract public function isPasswordValid(UserInterface $user, string $plainPassword): bool;





      /**
       * Rehash user password
       *
       * @param UserInterface $user
       *
       * @param string $plainPassword
       *
       * @return UserInterface
      */
      abstract public function rehashUserPassword(UserInterface $user, string $plainPassword): UserInterface;






      /**
       * @param UserInterface $user
       *
       * @param bool $rememberMe
       *
       * @return UserTokenInterface
      */
      abstract public function createToken(UserInterface $user, bool $rememberMe = false): UserTokenInterface;






      /**
       * @inheritDoc
      */
      public function isGranted(array $roles): bool
      {
           return ! empty(array_intersect($roles, $this->getUser()->getRoles()));
      }
}