<?php
namespace Laventure\Component\Routing\Route\Collection;

use Laventure\Component\Routing\Route\Group\RouteGroup;
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
       * store route by name
       *
       * @var Route[]
      */
      protected $namedRoutes = [];




      /**
       * @var RouteGroup[]
      */
      protected $groups = [];




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

          $this->addName($route);

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
           foreach ($this->getRoutes() as $route) {
               $this->addName($route);
           }

           return $this->namedRoutes;
      }




      /**
       * @param string $name
       * @return string
      */
      public function hasRouteNamed(string $name): string
      {
           return isset($this->getRoutesByName()[$name]);
      }





      /**
       * @param string $name
       *
       * @return Route|null
      */
      public function getRouteNamed(string $name): ?Route
      {
            return $this->getRoutesByName()[$name] ?? null;
      }





      /**
       * @param string $name
       *
       * @return bool
      */
      private function isNotAlreadyNamed(string $name): bool
      {
           return ! isset($this->namedRoutes[$name]);
      }

    /**
     * @param Route $route
     * @return $this
     */
    private function addName(Route $route): static
    {
        $name = $route->getName();

        if ($route->hasName() && $this->isNotAlreadyNamed($name)) {
            $this->namedRoutes[$name] = $route;
        }

        return $this;
    }
}

