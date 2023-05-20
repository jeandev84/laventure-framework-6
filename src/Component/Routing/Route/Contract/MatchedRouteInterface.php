<?php
namespace Laventure\Component\Routing\Route\Contract;



/**
 * @MatchedRouteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Contract
*/
interface MatchedRouteInterface
{

    /**
     * Determine if the current request matches route
     *
     *
     * @param string $requestMethod
     *
     * @param string $requestPath
     *
     * @return bool
    */
    public function match(string $requestMethod, string $requestPath): bool;
}