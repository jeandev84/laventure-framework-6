<?php
namespace Laventure\Component\Security\Encoder\Password;

use Laventure\Component\Security\Authentication\Contract\UserInterface;

interface UserPasswordEncoderInterface
{
      /**
       * @param UserInterface $user
       * @param string $plainPassword
       * @return mixed
      */
      public function encode(UserInterface $user, string $plainPassword);



      /**
       * @param UserInterface $user
       * @return mixed
      */
      public function decode(UserInterface $user);
}