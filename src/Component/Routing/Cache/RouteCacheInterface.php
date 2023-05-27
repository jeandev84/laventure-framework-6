<?php
namespace Laventure\Component\Routing\Cache;

use Laventure\Component\Routing\Route\Contract\RouteInterface;


interface RouteCacheInterface
{

    /**
     * @param string $cacheDir
     *
     * @return mixed
    */
    public function cacheRouteDir(string $cacheDir): mixed;




    /**
     * @param string $key
     *
     * @param RouteInterface $route
     *
     * @return mixed
    */
    public function cacheRoute(string $key, RouteInterface $route): mixed;




    /**
     * @param string $key
     *
     * @return bool
    */
    public function hasRoute(string $key): bool;




    /**
     * @param string $key
     *
     * @return RouteInterface|null
    */
    public function getRoute(string $key): ?RouteInterface;
}