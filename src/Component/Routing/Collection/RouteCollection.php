<?php
namespace Laventure\Component\Routing\Collection;


use Laventure\Component\Routing\Resource\Contract\Resource;
use Laventure\Component\Routing\Route\Route;



/**
 * @RouteCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Collection
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
       * @var Resource
      */
      protected $resources = [];




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
       * @param Resource $resource
       * @return $this
      */
      public function addResource(Resource $resource): static
      {
           $resourceType = $resource->getResourceType();

           $this->resources[$resourceType][$resource->getName()] = $resource;

           return $this;
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
           $namedRoutes = [];

           foreach ($this->getRoutes() as $route) {
               if ($name = $route->getName()) {
                   $namedRoutes[$name] = $route;
               }
           }

           return $namedRoutes;
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
      public function getRouteByName(string $name): ?Route
      {
            return $this->getRoutesByName()[$name] ?? null;
      }
}

