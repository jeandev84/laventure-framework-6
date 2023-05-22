<?php
namespace Laventure\Component\Routing;



use Closure;
use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Dispatcher\RouteDispatcher;
use Laventure\Component\Routing\Route\Dispatcher\RouteDispatcherInterface;
use Laventure\Component\Routing\Route\Exception\RouteNotFoundException;
use Laventure\Component\Routing\Route\Resource\ApiResource;
use Laventure\Component\Routing\Route\Resource\Contract\Resource;
use Laventure\Component\Routing\Route\Resource\WebResource;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteCache;
use Laventure\Component\Routing\Route\RouteGroup;
use Laventure\Component\Routing\Route\RouteMiddleware;
use Laventure\Component\Routing\Route\RouteParameter;
use Laventure\Component\Routing\Route\RouteResolver;


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
     * Route caching
     *
     * @var RouteCache
    */
    protected $cache;




    /**
     * Route middlewares
     *
     * @var array
    */
    protected $middlewares = [];





    /**
     * Route patterns
     *
     * @var array
    */
    protected $patterns = [
        'id' => '\d+'
    ];





    /**
     * Router construct
     *
     * @param RouteDispatcherInterface|null $dispatcher
    */
    public function __construct(RouteDispatcherInterface $dispatcher = null)
    {
         $this->collection = new RouteCollection();
         $this->group      = new RouteGroup();
         $this->cache      = new RouteCache();
         $this->dispatcher = $dispatcher ?: new RouteDispatcher();
    }





    /**
     * @param string $cacheDir
     *
     * @return $this
    */
    public function cacheDir(string $cacheDir): static
    {
         $this->cache->cacheDir($cacheDir);

         return $this;
    }




    /**
     * Add route middlewares
     *
     * @param array $middlewares
     *
     * @return $this
    */
    public function middlewareProvides(array $middlewares): static
    {
         $this->middlewares = $middlewares;

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
         $this->group->namespace($namespace);

         return $this;
    }




    /**
     * @param string $path
     * @return $this
    */
    public function prefix(string $path): static
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
          $this->group->middlewares((array)$middleware);

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
            $resolver  = new RouteResolver($this->group);
            $parameter = $resolver->resolveMappedParameters($methods, $path, $action);

            return Route::create($this->domain, $methods, $parameter->getPath(), $parameter->getAction())
                        ->middlewareProvides($this->middlewares)
                        ->wheres($this->patterns)
                        ->name($this->group->getName())
                        ->middleware($this->group->getMiddlewares())
                        ->options(['prefixes' => $this->group->getPrefixes()]);
    }




    /**
     * @param string $cacheKey
     *
     * @return Route|bool
    */
    public function getRouteFromCache(string $cacheKey): Route|bool
    {
        if (! $this->cache->has($cacheKey)) {
            return false;
        }

        return $this->cache->get($cacheKey);
    }




    /**
     * @param string $cacheKey
     *
     * @param Route $route
     *
     * @return $this
    */
    public function cacheRoute(string $cacheKey, Route $route): static
    {
         $this->cache->set($cacheKey, $route);

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function match(string $method, string $path): Route|bool
    {
         foreach ($this->getRoutes() as $route) {
              if ($route->match($method, $path)) {
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
     * @return string
    */
    public function getNamespace(): string
    {
        return $this->group->getNamespace();
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
        $this->group->prefixes($prefixes);

        $this->group->mapRoutes($routes, $this);

        $this->group->rewind();

        return $this;
    }



    /**
     * @param Resource $resource
     *
     * @return $this
    */
    public function addResource(Resource $resource): static
    {
        $resource->mapRoutes($this);

        $this->collection->addResource($resource);

        return $this;
    }





    /**
     * @param string $name
     *
     * @param string $controller
     *
     * @return $this
    */
    public function resource(string $name, string $controller): static
    {
          return $this->addResource(new WebResource($name, $controller));
    }




    /**
     * @param array $resources
     *
     * @return $this
    */
    public function resources(array $resources): static
    {
         foreach ($resources as $name => $controller) {
               $this->resource($name, $controller);
         }

         return $this;
    }





    /**
     * @param string $name
     *
     * @param string $controller
     *
     * @return $this
    */
    public function apiResource(string $name, string $controller): static
    {
        return $this->addResource(new ApiResource($name, $controller));
    }




    /**
     * @param array $resources
     *
     * @return $this
    */
    public function apiResources(array $resources): static
    {
         foreach ($resources as $name => $controller) {
             $this->apiResource($name, $controller);
         }

         return $this;
    }
}