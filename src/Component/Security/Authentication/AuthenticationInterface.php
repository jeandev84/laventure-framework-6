<?php
namespace Laventure\Component\Security\Authentication;

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
interface AuthenticationInterface
{

     /**
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
      * Login out user
      *
      * @return bool
     */
     public function logout(): bool;
}