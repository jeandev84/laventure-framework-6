<?php
namespace Laventure\Component\Routing\Route;


/**
 * @Route
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
*/
class RouteParameterResolver
{

     /**
      * @var string
     */
     protected $namespace;




     /**
      * @var RouteGroup
     */
     protected RouteGroup $group;




     /**
      * @param RouteGroup|null $group
      *
     */
     public function __construct(RouteGroup $group = null)
     {
           $this->group = $group ?: new RouteGroup();
     }




     /**
      * @param $methods
      * @param $path
      * @param $action
      * @return array
     */
     public function resolve($methods, $path, $action): array
     {
          return [$methods, $this->resolvePath($path), $this->resolveAction($action)];
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
        return sprintf('%s%s', $this->group->getNamespace(), $controller);
    }
}