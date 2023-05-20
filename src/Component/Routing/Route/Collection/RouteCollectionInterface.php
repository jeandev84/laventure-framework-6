<?php
namespace Laventure\Component\Routing\Route\Collection;


/**
 * @RouteCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Collection
*/
interface RouteCollectionInterface
{
      /**
       * Returns routes
       *
       * @return mixed
      */
      public function getRoutes();
}