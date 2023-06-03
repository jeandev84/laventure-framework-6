<?php
namespace Laventure\Component\Message\Http;


use Laventure\Component\Http\Message\Request;
use Laventure\Component\Http\Message\Response;


/**
 * @Kernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Message\Http
*/
interface Kernel
{

    /**
     * Get request and return response
     *
     * @param Request $request
     *
     * @return mixed
    */
    public function handle(Request $request): Response;





    /**
     * Map the current request and current response for terminate handle.
     *
     * @param Request $request
     *
     * @param Response $response
     *
     * @return mixed
    */
    public function terminate(Request $request, Response $response);
}