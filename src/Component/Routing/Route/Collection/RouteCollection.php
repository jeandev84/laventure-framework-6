<?php
namespace Laventure\Component\Routing\Route\Collection;

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
       * @param Route $route
       *
       * @return Route
      */
      public function addRoute(Route $route): Route
      {
          $this->addMethods($route);
          $this->addController($route);
          $this->addName($route);

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
     private function addMethods(Route $route): static
     {
         $methods = $route->getMethodsAsString();

         $this->methods[$methods][] = $route;

        return $this;
    }



    private function addController(Route $route): static
    {
        if ($route->hasController()) {
            $this->controllers[$route->getController()][] = $route;
        }

        return $this;
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

