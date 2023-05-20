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
      * @param array $methods
      *
      * @param string $path
      *
      * @param $action
      *
      * @return Route
     */
     public static function createRoute(array $methods, string $path, $action): Route
     {
          return new Route($methods, $path, $action);
     }
}