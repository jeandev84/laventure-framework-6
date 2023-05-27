<?php
namespace Laventure\Component\Routing\Collection;


use Laventure\Component\Routing\Route\Contract\RouteInterface;

/**
 * @RouteCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Collection
*/
interface RouteCollectionInterface
{
      /**
       * Returns routes
       *
       * @return RouteInterface[]
      */
      public function getRoutes(): array;
}