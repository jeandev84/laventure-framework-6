<?php
namespace Laventure\Component\Security\User;

/**
 * @UserProviderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User
*/
interface UserProviderInterface
{

     /**
      * Returns user
      *
      * @param string $username
      *
      * @return UserInterface
     */
     public function findByUsername(string $username): UserInterface;
}