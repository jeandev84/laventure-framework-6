<?php
namespace Laventure\Component\Routing\Route\Collection;

use Laventure\Component\Routing\Route\Collector;
use Laventure\Component\Routing\Route\Group\RouteGroup;
use Laventure\Component\Routing\Route\NamedRouteCollector;
use Laventure\Component\Routing\Route\Route;

/**
 * @RouteCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Collection
*/
class RouteCollection implements RouteCollectionInterface
{

      /**
       * store all routes
       *
       * @var Route[]
      */
      protected $routes = [];




      /**
       * store routes by method
       *
       * @var Route[]
      */
      protected $methods = [];



      /**
       * store routes by controller
       *
       * @var Route[]
      */
      protected $controllers = [];




      /**
       * @var RouteGroup[]
      */
      protected $groups = [];




      /**
       * @var Route[]
      */
      public static $namedRoutes = [];




      /**
       * @param Route $route
       *
       * @return Route
      */
      public function addRoute(Route $route): Route
      {
          $this->methods[$route->getMethodsAsString()][] = $route;

          if ($route->hasController()) {
              $this->controllers[$route->getController()][] = $route;
          }

          $this->routes[] = $route;

          return $route;
      }




      /**
       * @param RouteGroup $group
       *
       * @return RouteGroup
      */
      public function addGroup(RouteGroup $group): RouteGroup
      {
          $this->groups[] = $group;

          $group->rewind();

          return $group;
      }




      /**
       * Returns all routes
       *
       * @return Route[]
      */
      public function getRoutes(): array
      {
          return $this->routes;
      }




     /**
      * @return RouteGroup[]
     */
     public function getGroups(): array
     {
          return $this->groups;
     }



      /**
       * Returns route by methods
       *
       * @return Route[]
      */
      public function getRoutesByMethod(): array
      {
           return $this->methods;
      }




      /**
       * Returns routes by controller
       *
       * @return Route[]
      */
      public function getRoutesByController(): array
      {
           return $this->controllers;
      }




      /**
       * Returns routes by name [ named routes ]
       *
       * @return Route[]
      */
      public function getRoutesByName(): array
      {
           return static::$namedRoutes;
      }




      /**
       * @param string $name
       * @return string
      */
      public function hasRouteNamed(string $name): string
      {
           return isset(static::$namedRoutes[$name]);
      }





      /**
       * @param string $name
       *
       * @return Route|null
      */
      public function getRouteByName(string $name): ?Route
      {
            return static::$namedRoutes[$name] ?? null;
      }
}

