<?php
namespace Laventure\Component\Security\Authentication\Exception;

class UserBadCredentialsException extends AuthenticationException
{
     public function __construct()
     {
         parent::__construct("Incorrect username or password", 409);
     }
}