<?php
namespace Laventure\Component\Security\Authorization\User;


use Laventure\Component\Security\Authentication\User\UserInterface;


/**
 * @AuthenticatedUserInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authorization\User
*/
interface AuthenticatedUserInterface extends UserInterface
{
     /**
      * Returns if user has given role
      *
      * @param string $role
      *
      * @return bool
     */
     public function hasRole(string $role): bool;
}