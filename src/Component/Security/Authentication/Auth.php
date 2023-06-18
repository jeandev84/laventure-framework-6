<?php
namespace Laventure\Component\Security\Authentication;

use Laventure\Component\Security\User\UserInterface;
use Laventure\Component\Security\User\UserTokenInterface;


/**
 * @Auth
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authentication
*/
class Auth
{

     /**
      * @var AuthenticatorInterface
     */
     protected AuthenticatorInterface $authenticator;



     /**
      * @param AuthenticatorInterface $authenticator
     */
     public function __construct(AuthenticatorInterface $authenticator)
     {
         $this->authenticator = $authenticator;
     }




     /**
      * authenticate user
      *
      * @param string $username
      *
      * @param string $password
      *
      * @param bool $rememberMe
      *
      * @return bool
     */
     public function attempt(string $username, string $password, bool $rememberMe = false): bool
     {
          return $this->authenticator->attempt($username, $password, $rememberMe);
     }





     /**
      * @return UserInterface
     */
     public function getUser(): UserInterface
     {
          return $this->authenticator->getUser();
     }




     /**
      * @return bool
     */
     public function logout(): bool
     {
         return $this->authenticator->logout();
     }
}