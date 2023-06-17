<?php
namespace Laventure\Component\Http\Message;


use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Response;

/**
 * @HttpKernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message
*/
interface HttpKernel
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