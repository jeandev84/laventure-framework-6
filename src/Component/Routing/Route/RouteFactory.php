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
     public static function create($domain, $methods, $path, $action, array $middlewares = []): Route
     {
          $route = Route::make($domain, $methods, $path, $action);
          $route->middlewares($middlewares);
          return $route;
     }
}