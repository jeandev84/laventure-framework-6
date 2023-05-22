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
     * @var array
     */
    protected $path = [];




    /**
     * @var string
    */
    protected $module = [];




    /**
     * @var string
    */
    protected $name = [];




    /**
     * @var array
    */
    protected $middlewares = [];





    /**
     * Route namespace
     *
     * @var string
    */
    protected $namespace;




    /**
     * @param string $namespace
     *
     * @return $this
    */
    public function namespace(string $namespace): static
    {
         $this->namespace = trim($namespace, '\\');

         return $this;
    }




    /**
     * @param array $prefixes
     *
     * @return $this
    */
    public function prefixes(array $prefixes): static
    {
        foreach ($prefixes as $name => $value) {
            if (property_exists($this, $name)) {
                call_user_func([$this, $name], $value);
            }
        }

        return $this;
    }




    /**
     * @param Closure $routes
     *
     * @param Router $router
     *
     * @return $this
     */
    public function mapRoutes(Closure $routes, Router $router): static
    {
         call_user_func($routes, $router);

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
     * @return string|null
    */
    public function getPath(): ?string
    {
        return join('/', $this->path);
    }






    /**
     * @param string $module
     * @return $this
     */
    public function module(string $module): self
    {
        $this->module[] = trim($module, '\\') . "\\";

        return $this;
    }




    /**
     * @return string|null
    */
    public function getModule(): ?string
    {
        return join($this->module);
    }





    /**
     * Returns group namespace
     *
     * @return string
    */
    public function getNamespace(): string
    {
        if (! $this->namespace) {
            throw new \InvalidArgumentException("group namespace is not established.");
        }

        if ($module = $this->getModule()) {
            return sprintf('%s\\%s', $this->namespace, $module);
        }

        return $this->namespace;
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
     * @return string|null
    */
    public function getName(): ?string
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