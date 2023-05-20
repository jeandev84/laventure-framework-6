<?php
namespace Laventure\Component\Routing\Route;

class RouteFactory
{
     /**
      * @param array $methods
      * @param string $path
      * @param $action
      * @return Route
     */
     public static function createRoute(array $methods, string $path, $action): Route
     {
          return new Route($methods, $path, $action);
     }
}