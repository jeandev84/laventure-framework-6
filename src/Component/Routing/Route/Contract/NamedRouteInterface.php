<?php
namespace Laventure\Component\Routing\Route\Contract;


/**
 * @NamedRouteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Contract
*/
interface NamedRouteInterface extends RouteInterface
{

      /**
       * Return name of route
       *
       * @return string
      */
      public function getName();
}