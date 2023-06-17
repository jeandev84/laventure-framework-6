<?php
namespace Laventure\Component\Security\User;


/**
 * @UserPermissionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User
*/
interface UserPermissionInterface
{

      /**
       * @param UserInterface $user
       * @param array $roles
       *
       * @return bool
      */
      public function hasPermissions(UserInterface $user, array $roles): bool;
}