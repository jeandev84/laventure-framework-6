<?php
namespace Laventure\Component\Security\Authentication\User;


/**
 * @UserInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authentication\User
*/
interface UserInterface
{

     const ROLE_USER = 'ROLE_USER';


     /**
      * Return username or email
      *
      * @return string|null
     */
     public function getUsername(): ?string;




     /**
      * @return string|null
     */
     public function getPassword(): ?string;




     /**
      * Returns salt for encoding user password
      *
      * @return string
     */
     public function getSalt(): string;




    /**
     * Returns user roles
    */
    public function getRoles(): array;
}