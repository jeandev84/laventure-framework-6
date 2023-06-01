<?php
namespace Laventure\Component\Security\Authorization\User\Permission;

interface UserPermissionInterface
{

     /**
      * Returns user roles
     */
     public function getRoles(): array;




     /**
      * Returns if user has given role
      *
      * @param string $role
      *
      * @return bool
     */
     public function hasRole(string $role): bool;
}