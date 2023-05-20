<?php
namespace Laventure\Component\Routing;



use Closure;
use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Dispatcher\RouteDispatcher;
use Laventure\Component\Routing\Route\Dispatcher\RouteDispatcherInterface;
use Laventure\Component\Routing\Route\Exception\RouteNotFoundException;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteFactory;
use Laventure\Component\Routing\Route\RouteGroup;


/**
 * @Router
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing
*/
class Router implements RouterInterface
{


    /**
     * Route collection
     *
     * @var RouteCollection
    */
    protected $collection;



    /**
     * Route dispatcher
     *
     * @var RouteDispatcherInterface
    */
    protected $dispatcher;





    /**
     * Route Group
     *
     * @var RouteGroup
    */
    protected $group;





    /**
     * Route domain
     *
     * @var string
    */
    protected $domain;





    /**
     * @var string
    */
    protected $namespace;





    /**
     * Route patterns
     *
     * @var array
    */
    protected $patterns = [];






    /**
     * Route middlewares
     *
     * @var array
    */
    protected $middlewares = [];





    /**
     * Router construct
     *
     * @param RouteDispatcherInterface|null $dispatcher
    */
    public function __construct(RouteDispatcherInterface $dispatcher = null)
    {
         $this->collection = new RouteCollection();
         $this->group      = new RouteGroup();
         $this->dispatcher = $dispatcher ?: new RouteDispatcher();
    }





    /**
     * Add route middlewares
     *
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewares(array $middlewares): static
    {
         foreach ($middlewares as $name => $middleware) {
             $this->addMiddleware($name, $middleware);
         }

         return $this;
    }





    /**
     * @param string $domain
     *
     * @return $this
    */
    public function domain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }






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
     * @param string $path
     * @return $this
    */
    public function path(string $path): static
    {
         $this->group->path($path);

         return $this;
    }



    /**
     * @param string $module
     *
     * @return $this
    */
    public function module(string $module): static
    {
        $this->group->module($module);

        return $this;
    }




    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static
    {
         $this->group->name($name);

         return $this;
    }




    /**
     * @param $middleware
     * @return $this
    */
    public function middleware($middleware): static
    {
          $this->group->middlewares($middleware);

          return $this;
    }





    /**
     * @param array $patterns
     *
     * @return $this
    */
    public function patterns(array $patterns): static
    {
        $this->patterns = array_merge($this->patterns, $patterns);

        return $this;
    }






    /**
     * Returns route collection object
     *
     * @return RouteCollection
    */
    public function getCollection(): RouteCollection
    {
        return $this->collection;
    }





    /**
     * @inheritDoc
    */
    public function getRoutes()
    {
        return $this->collection->getRoutes();
    }




    /**
     * Add a new route to the collection
     *
     * @param Route $route
     *
     * @return Route
    */
    public function add(Route $route): Route
    {
         return $this->collection->addRoute($route);
    }




    /**
     * @param string $methods
     *
     * @param string $path
     *
     * @param mixed $action
     *
     * @return Route
    */
    public function makeRoute(string $methods, string $path, mixed $action): Route
    {
          return RouteFactory::route($methods, $this->resolvePath($path), $this->resolveAction($action))
                            ->domain($this->domain)
                            ->wheres($this->patterns)
                            ->name($this->group->getName())
                            ->middleware($this->group->getMiddlewares());
    }




    /**
     * Map routes called by any request
     *
     * @param $methods
     *
     * @param $path
     *
     * @param $action
     * @return Route
    */
    public function map($methods, $path, $action): Route
    {
         return $this->add($this->makeRoute($methods, $path, $action));
    }




    /**
     * Map route called by method GET
     *
     * @param $path
     *
     * @param $action
     *
     * @return Route
     */
    public function get($path, $action): Route
    {
        return $this->map('GET', $path, $action);
    }





    /**
     * Map route called by method POST
     *
     * @param $path
     *
     * @param $action
     *
     * @return Route
    */
    public function post($path, $action): Route
    {
        return $this->map('POST', $path, $action);
    }




    /**
     * Map route called by method PUT
     *
     * @param $path
     *
     * @param $action
     *
     * @return Route
    */
    public function put($path, $action): Route
    {
        return $this->map('PUT', $path, $action);
    }






    /**
     * Map route called by method PATCH
     *
     * @param $path
     *
     * @param $action
     *
     * @return Route
    */
    public function patch($path, $action): Route
    {
        return $this->map('PATCH', $path, $action);
    }





    /**
     * Map route called by method DELETE
     *
     * @param $path
     *
     * @param $action
     *
     * @return Route
    */
    public function delete($path, $action): Route
    {
        return $this->map('DELETE', $path, $action);
    }


    /**
     * @param array $prefixes
     *
     * @param Closure $routes
     *
     * @return $this
    */
    public function group(array $prefixes, Closure $routes): static
    {
         $group    = RouteFactory::group($this->group->toArray(), $routes);
         $group->prefixes($prefixes);
         $this->group = $group;
         $this->group->map($this);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function match(string $requestMethod, string $requestPath): Route|bool
    {
         foreach ($this->getRoutes() as $route) {
              if ($route->match($requestMethod, $requestPath)) {
                   return $route;
              }
         }

         return false;
    }






    /**
     * @param string $requestMethod
     *
     * @param string $requestPath
     *
     * @return mixed
     *
     * @throws RouteNotFoundException
    */
    public function dispatchRoute(string $requestMethod, string $requestPath): mixed
    {
          if (! $route = $this->match($requestMethod, $requestPath)) {
               throw new RouteNotFoundException("Route $requestPath not found.!");
          }

          return $this->dispatcher->dispatchRoute($route);
    }




    /**
     * @inheritDoc
    */
    public function generate(string $name, array $parameters = []): ?string
    {
        if (! $route = $this->collection->getRouteByName($name)) {
             return null;
        }

        return $route->uri($parameters);
    }


    /**
     * @param string $name
     *
     * @param string $middleware
     *
     * @return $this
    */
    private function addMiddleware(string $name, string $middleware): static
    {
         $this->middlewares[$name] = $middleware;

         return $this;
    }




    /**
     * @return string
     */
    public function getNamespace(): string
    {
        if (! $this->namespace) {
             throw new \InvalidArgumentException("Unable namespace: ". __FILE__);
        }

        if ($module = $this->group->getModule()) {
            $this->namespace .= sprintf('\\%s', $module);
        }

        return $this->namespace;
    }





    /**
     * @param string $path
     * @return string
    */
    protected function resolvePath(string $path): string
    {
        if ($prefix = $this->group->getPath()) {
            $path = sprintf('%s/%s', $prefix, ltrim($path, '/'));
        }

        return $path;
    }




    /**
     * @param $callback
     *
     * @return mixed
    */
    protected function resolveAction($callback)
    {
         if (is_string($callback) && stripos($callback, '@') === false) {
              [$controller, $action] = explode('@', $callback, 2);
              return [$this->resolveController($controller), $action];
         }

         return $callback;
    }




    /**
     * @param string $controller
     *
     * @return string
    */
    private function resolveController(string $controller): string
    {
        return sprintf('%s\\%s', $this->getNamespace(), $controller);
    }
}