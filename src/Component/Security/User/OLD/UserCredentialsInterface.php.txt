<?php
namespace Laventure\Component\Security\User;


/**
 * @UserCredentialsInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User
*/
interface UserCredentialsInterface
{

     /**
      * @return string
     */
     public function getUsername(): string;



     /**
      * @return string
     */
     public function getPlainPassword(): string;



     /**
      * @return bool
     */
     public function getRememberMe(): bool;
}