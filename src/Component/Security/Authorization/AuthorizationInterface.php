<?php
namespace Laventure\Component\Security\Authorization;

use Laventure\Component\Security\User\UserInterface;

interface AuthorizationInterface
{

     /**
      * @return UserInterface
     */
     public function getUser(): UserInterface;



     /**
      * @param array $roles
      *
      * @return mixed
     */
     public function isGranted(array $roles);
}