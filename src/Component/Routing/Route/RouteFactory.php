<?php
namespace Laventure\Component\Routing\Route;



/**
 * @RouteFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
 */
class RouteFactory
{
     /**
      * @param array|string $methods
      *
      * @param string $path
      *
      * @param mixed $action
      *
      * @return Route
     */
     public static function createRoute($methods, $path, $action): Route
     {
          return new Route($methods, $path, $action);
     }
}