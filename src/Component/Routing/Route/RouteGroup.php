<?php
namespace Laventure\Component\Routing\Route;


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
class RouteGroup
{


    /**
     * @var string
     */
    protected $path;




    /**
     * @var string
     */
    protected $module;




    /**
     * @var string
    */
    protected $name;




    /**
     * @var array
    */
    protected $middlewares = [];



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
     * @param array $prefixes
     * @param Closure $routes
     * @param Router $router
     *
     * @return $this
    */
    public function map(array $prefixes, Closure $routes, Router $router): static
    {
         $this->prefixes($prefixes);

         call_user_func($routes, $router);

         $this->rewind();

         return $this;
    }




    /**
     * @param string $prefix
     * @return $this
    */
    public function path(string $prefix): static
    {
        $this->path .= '/'. trim($prefix, '\\/');

        return $this;
    }


    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }






    /**
     * @param string $module
     * @return $this
     */
    public function module(string $module): self
    {
        $this->module .= trim($module, '\\');

        return $this;
    }




    /**
     * @return string|null
    */
    public function getModule(): ?string
    {
        return  $this->module;
    }




    /**
     * @param string $name
     * @return $this
    */
    public function name(string $name): self
    {
        $this->name .= $name;

        return $this;
    }



    /**
     * @return string|null
    */
    public function getName(): ?string
    {
        return $this->name;
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
        $this->path   = null;
        $this->module = null;
        $this->name   = null;
        $this->middlewares = [];
    }
}