<?php
namespace Laventure\Component\Routing\Route;


class RouteResolver
{


     /**
      * @param RouteGroup $group
      *
      * @param string $namespace
     */
     public function __construct(protected RouteGroup $group, protected string $namespace)
     {
     }


     /**
      * @param $methods
      * @param $path
      * @param $action
      * @return RouteParameter
     */
     public function resolveRouteParameters($methods, $path, $action): RouteParameter
     {
          return new RouteParameter($methods, $this->resolvePath($path), $this->resolveAction($action));
     }





     /**
      * @param string $path
      *
      * @return string
     */
     public function resolvePath(string $path): string
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
    public function resolveAction($callback): mixed
    {
        if (is_string($callback) && stripos($callback, '@') !== false) {
            [$controller, $method] = explode('@', $callback, 2);
            return [$this->resolveController($controller), $method];
        }

        return $callback;
    }



    /**
     * @param string $controller
     * @return string
    */
    public function resolveController(string $controller): string
    {
        return sprintf('%s%s', $this->resolveNamespace(), $controller);
    }






    /**
     * @return string
    */
    public function resolveNamespace(): string
    {
        if (! $this->namespace) {
            throw new \InvalidArgumentException("Unable namespace: ". __FILE__);
        }

        if ($module = $this->group->getModule()) {
            return sprintf('%s\\%s', $this->namespace, $module);
        }

        return sprintf('%s\\', $this->namespace);
    }
}