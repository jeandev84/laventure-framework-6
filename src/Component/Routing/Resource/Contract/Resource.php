<?php
namespace Laventure\Component\Routing\Resource\Contract;


use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Router;

/**
 * @RouteResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Resource\Stack
*/
abstract class Resource
{


    /**
     * Routes
     *
     * @var Route[]
    */
    protected $routes = [];




    /**
     * @var string
    */
    protected $name;




    /**
     * @var string
    */
    protected $controller;




    /**
     * @param string $name
     * @param string $controller
    */
    public function __construct(string $name, string $controller)
    {
         $this->name       = strtolower($name);
         $this->controller = $controller;
    }



    /**
     * @param string $suffix
     *
     * @return string
    */
    protected function path(string $suffix = ''): string
    {
        return "/{$this->name}". ($suffix ? "/". ltrim($suffix, '\\/') : $suffix);
    }






    /**
     * @param string $action
     *
     * @return array|string
    */
    protected function action(string $action): array|string
    {
         if (class_exists($this->controller)) {
              return [$this->controller, $action];
         }

         return "$this->controller@$action";
    }





    /**
     * @param string $name
     * @return string
    */
    protected function name(string $name): string
    {
         return "$this->name.$name";
    }




    /**
     * @param Route $route
     *
     * @return $this
    */
    public function addRoute(Route $route): static
    {
        $route->name($this->name($route->getAction()));

        $this->routes[] = $route;

        return $this;
    }




    /**
     * @return Route[]
    */
    public function getRoutes(): array
    {
        return $this->routes;
    }






    /**
     * @return string
    */
    public function getController(): string
    {
        return $this->controller;
    }





    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }





    /**
     * @param Router $router
     *
     * @return $this
    */
    abstract public function mapRoutes(Router $router): static;






    /**
     * @return string
    */
    abstract public function getTypeName(): string;
}