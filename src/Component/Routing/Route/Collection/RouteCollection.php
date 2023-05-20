<?php
namespace Laventure\Component\Routing\Route\Collection;

use Laventure\Component\Routing\Route\Mix;
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
       * Returns all routes
       *
       * @return Route[]
      */
      public function getRoutes(): array
      {
          return $this->routes;
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
           return Mix::$namedRoutes;
      }




      /**
       * @param string $name
       * @return string
      */
      public function hasRouteNamed(string $name): string
      {
           return isset(Mix::$namedRoutes[$name]);
      }





      /**
       * @param string $name
       *
       * @return Route|null
      */
      public function getRouteByName(string $name): ?Route
      {
            return Mix::$namedRoutes[$name] ?? null;
      }
}

