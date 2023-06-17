<?php
namespace Laventure\Component\Security\User;



/**
 * @UserStorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User
*/
interface UserStorageInterface
{

      /**
       * Determine if has user in session
       *
       * @return bool
      */
      public function hasUserInSession(): bool;





      /**
       * Returns user from the session
       *
       * @return UserInterface
      */
      public function getUser(): UserInterface;





      /**
       * Save user in session
       *
       * @param UserInterface $user
       *
       * @return static
      */
      public function setUserSession(UserInterface $user): static;





      /**
       * Save user token in cookie
       *
       * @param UserProviderInterface $provider
       * @return $this
      */
      public function setRememberToken(UserProviderInterface $provider): static;




      /**
       * @param UserProviderInterface $provider
       *
       * @return bool
      */
      public function clear(UserProviderInterface $provider): bool;
}