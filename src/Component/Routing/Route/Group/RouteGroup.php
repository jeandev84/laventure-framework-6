<?php
namespace Laventure\Component\Routing\Route\Group;


use Closure;
use Laventure\Component\Routing\Router;

/**
 * @RouteGroup
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Group
*/
class RouteGroup implements RouteGroupInterface
{


    /**
     * @var array
     */
    protected $path = [];




    /**
     * @var array
     */
    protected $module  = [];




    /**
     * @var array
     */
    protected $name = [];




    /**
     * @var array
     */
    protected $middlewares = [];





    /**
     * @var Closure
    */
    protected $routes;


    /**
     * RouteGroup constructor
     *
     * @param $prefixes
     * @param $routes
    */
    public function __construct($prefixes = [], $routes = null)
    {
         $this->prefixes($prefixes);
         $this->routes($routes);
    }





    /**
     * @param array $prefixes
     *
     * @return $this
    */
    public function prefixes(array $prefixes): static
    {
        foreach ($prefixes as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func([$this, $name], $value);
            }
        }

        return $this;
    }


    /**
     * @param Closure|null $routes
     *
     * @return $this
     */
    public function routes(?Closure $routes): static
    {
         $this->routes = $routes;

         return $this;
    }





     /**
      * @param Router $router
      *
      * @return static
    */
    public function map(Router $router): static
    {
         call_user_func($this->routes, $router);

         return $this;
    }




    /**
     * @param string $prefix
     * @return $this
    */
    public function path(string $prefix): static
    {
        $this->path[] = trim($prefix, '\\/');

        return $this;
    }




    /**
     * @return string
     */
    public function getPath(): string
    {
        return join('/', $this->path);
    }






    /**
     * @param string $module
     * @return $this
     */
    public function module(string $module): self
    {
        $this->module[] = trim($module, '\\');

        return $this;
    }




    /**
     * @return string
    */
    public function getModule(): string
    {
        return join('\\', $this->module);
    }




    /**
     * @param string $name
     * @return $this
    */
    public function name(string $name): self
    {
        $this->name[] = $name;

        return $this;
    }




    /**
     * @return string
    */
    public function getName(): string
    {
        return join($this->name);
    }





    /**
     * @param array $middlewares
     * @return $this
     */
    public function middlewares(array $middlewares): self
    {
        $this->middlewares = array_merge($this->middlewares, $middlewares);

        return $this;
    }




    /**
     * @return array
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }





    /**
     * @return array
    */
    public function toArray(): array
    {
        return $this->getPrefixes();
    }





    /**
     * @return array
    */
    public function getPrefixes(): array
    {
        return [
            'path'        => $this->getPath(),
            'module'      => $this->getModule(),
            'name'        => $this->getName(),
            'middlewares' => $this->getMiddlewares()
        ];
    }





    /**
     * @return void
    */
    public function rewind(): void
    {
        $this->path   = [];
        $this->module = [];
        $this->name   = [];
        $this->middlewares = [];
    }

}