<?php
namespace Laventure\Component\Security\User\Token;

use Laventure\Component\Security\User\UserInterface;


/**
 * @UserTokenStorage
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\User\Token
*/
interface UserTokenStorage
{
      /**
       * @param UserTokenInterface $token
       *
       * @return mixed
      */
      public function setToken(UserTokenInterface $token);




      /**
       * @return UserTokenInterface
      */
      public function getToken(): UserTokenInterface;




      /**
       * @return UserInterface
      */
      public function getUser(): UserInterface;
}