<?php
namespace Laventure\Component\Http\Client;

use Laventure\Component\Http\Request\Contract\RequestInterface;
use Laventure\Component\Http\Response\Contract\ResponseInterface;

/**
 * @ClientInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Client\ClientInterface
*/
interface ClientInterface
{

    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface If an error happens while processing the request.
    */
    public function sendRequest(RequestInterface $request): ResponseInterface;
}