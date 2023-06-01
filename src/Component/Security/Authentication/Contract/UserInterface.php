<?php
namespace Laventure\Component\Security\Authentication\Contract;

use Laventure\Component\Security\Authorization\UserPermissionInterface;


interface UserInterface extends UserPermissionInterface
{

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
}