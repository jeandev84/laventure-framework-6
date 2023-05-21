<?php
namespace Laventure\Component\Routing\Route;


class RouteParameterResolver
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
     * @param RouteParameter $parameter
     * @return RouteParameter
     */
     public function resolveParameters(RouteParameter $parameter): RouteParameter
     {
          return new RouteParameter(
              $parameter->getMethods(),
              $this->resolvePath($parameter->getPath()),
              $this->resolveAction($parameter->getAction())
          );
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