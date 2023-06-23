<?php
namespace Laventure\Component\Security\Authentication;


/**
 * @Authentication
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Authentication
*/
abstract class Authenticator implements AuthenticatorInterface
{
      /**
       * @inheritDoc
      */
      public function isGranted(array $roles): bool
      {
           return ! empty(array_intersect($roles, $this->getUser()->getRoles()));
      }
}