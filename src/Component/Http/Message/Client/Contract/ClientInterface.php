<?php
namespace Laventure\Component\Http\Message\Client\Contract;

use Laventure\Component\Http\Message\Client\Exception\ClientExceptionInterface;
use Laventure\Component\Http\Message\Request\Contract\RequestInterface;
use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;

/**
 * @ClientInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client\Contract
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