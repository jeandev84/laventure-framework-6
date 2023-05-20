<?php
namespace Laventure\Component\Routing;



use Closure;
use Laventure\Component\Routing\Route\Collection\RouteCollection;
use Laventure\Component\Routing\Route\Dispatcher\RouteDispatcher;
use Laventure\Component\Routing\Route\Dispatcher\RouteDispatcherInterface;
use Laventure\Component\Routing\Route\Exception\RouteNotFoundException;
use Laventure\Component\Routing\Route\Route;
use Laventure\Component\Routing\Route\RouteFactory;


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
     * Route domain
     *
     * @var string
    */
    protected $domain;




    /**
     * Route patterns
     *
     * @var array
    */
    protected $patterns = [];




    /**
     * @var
    */
    protected $cacheRoutes;




    /**
     * Router construct
     *
     * @param RouteDispatcherInterface|null $dispatcher
    */
    public function __construct(RouteDispatcherInterface $dispatcher = null)
    {
         $this->collection = new RouteCollection();
         $this->dispatcher = $dispatcher ?: new RouteDispatcher();
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
     * @param array $patterns
     *
     * @return $this
    */
    public function patterns(array $patterns): static
    {
        $this->patterns = $patterns;

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
          $methods = $this->resolveMethods($methods);

          $route = RouteFactory::createRoute($methods, $path, $action);

          $route->domain($this->domain)
                ->wheres($this->patterns);

          return $route;
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
    public function generate(string $name, array $parameters = [])
    {

    }






    /**
     * Resolve methods
     *
     * @param string $methods
     *
     * @return string[]
    */
    protected function resolveMethods(string $methods): array
    {
         return explode("|", $methods);
    }
}