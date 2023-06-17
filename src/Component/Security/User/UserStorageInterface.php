<?php
namespace Laventure\Component\Security\Authentication\User;

use Laventure\Component\Security\User\UserInterface;

interface UserStorageInterface
{

      /**
       * @param UserInterface $user
       *
       * @return mixed
      */
      public function setUser(UserInterface $user);





      /**
       * @return UserInterface
      */
      public function getUser(): UserInterface;
}