<?php
namespace Laventure\Component\Routing\Collection;

use Laventure\Component\Routing\Collection\Contract\RouteCollectionInterface;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteFactory;


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
          $this->methods[$route->getMethodsAsString()] = $route;

          if ($route->hasController()) {
              $this->controllers[$route->getController()] = $route;
          } elseif ($route->hasName()) {
              $this->namedRoutes[$route->getName()] = $route;
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
       * Returns only named routes
       *
       * @return Route[]
      */
      public function getNamedRoutes(): array
      {
          return $this->namedRoutes;
      }





      /**
       * Returns routes by name
       *
       * @return Route[]
      */
      public function getRoutesByName(): array
      {
           foreach ($this->getRoutes() as $route) {
               $name = $route->getName();
               if ($route->hasName() && ! isset($this->namedRoutes[$name])) {
                   $this->namedRoutes[$name] = $route;
               }
           }

           return $this->namedRoutes;
      }




      /**
       * @param string $name
       * @return string
      */
      public function hasRouteNamed(string $name): string
      {
           return isset($this->getNamedRoutes()[$name]);
      }
}

