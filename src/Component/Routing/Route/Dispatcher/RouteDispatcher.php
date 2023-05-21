<?php
namespace Laventure\Component\Routing\Route\Dispatcher;


use Laventure\Component\Routing\Route\Route;

/**
 * @RouteDispatcher
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Dispatcher
*/
class RouteDispatcher implements RouteDispatcherInterface
{

    /**
     * @inheritDoc
    */
    public function dispatchRoute(Route $route): mixed
    {
         if ($route->isCallable()) {
             return $route->callClosure();
         }

         return $route->callAction();
    }
}