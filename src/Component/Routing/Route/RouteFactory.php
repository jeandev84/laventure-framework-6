<?php
namespace Laventure\Component\Routing\Route;



use Closure;
use Laventure\Component\Routing\Route\Group\RouteGroup;

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
       * @param array $prefixes
       *
       * @return Route
     */
     public static function route($methods, $path, $action, array $prefixes = []): Route
     {
          return new Route($methods, $path, $action, $prefixes);
     }


    /**
     * @param array $prefixes
     * @param Closure|null $routes
     * @return RouteGroup
     */
     public static function group(array $prefixes = [], Closure $routes = null): RouteGroup
     {
          return new RouteGroup($prefixes, $routes);
     }
}