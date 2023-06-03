<?php
namespace Laventure\Component\Http\Middleware;

use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Response;

/**
 * @Middleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Middleware
*/
interface Middleware
{

      /**
       * @param Request $request
       *
       * @param callable $next
       *
       * @return Response
      */
      public function handle(Request $request, callable $next): Response;





      /**
       * @param Request $request
       *
       * @param Response $response
       *
       * @return Response
      */
      public function terminate(Request $request, Response $response): Response;
}