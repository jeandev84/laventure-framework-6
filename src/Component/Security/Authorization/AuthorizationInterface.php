<?php
namespace Laventure\Component\Security\Authorization;

interface AuthorizationInterface
{
     /**
      * @param array $roles
      * @return mixed
     */
     public function isGranted(array $roles);
}