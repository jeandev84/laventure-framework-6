<?php
namespace Laventure\Component\Http\Message\Client\Exception;

use Laventure\Component\Http\Message\Request\Contract\RequestInterface;

/**
 * Exception for when a request failed.
 *
 * Examples:
 *      - cUrlRequest is invalid (e.g. method is missing)
 *      - Runtime request errors (e.g. the body stream is not seekable)
*/
interface RequestExceptionInterface extends ClientExceptionInterface
{
    /**
     * Returns the request.
     *
     * The request object MAY be a different object from the one passed to ClientInterface::sendRequest()
     *
     * @return RequestInterface
    */
    public function getRequest(): RequestInterface;
}