<?php
namespace Laventure\Component\Http\Server;

use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;


/**
 * @see https://www.php-fig.org/psr/psr-15/
 *
 * Handles a server request and produces a response.
 *
 * An HTTP request handler process an HTTP request in order to produce an
 * HTTP response.
*/
interface RequestHandlerInterface
{
    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
    */
    public function handle(ServerRequestInterface $request): ResponseInterface;
}