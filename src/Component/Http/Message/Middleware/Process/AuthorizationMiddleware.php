<?php
namespace Laventure\Component\Http\Message\Middleware\Process;

use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;
use Laventure\Component\Http\Server\MiddlewareInterface;
use Laventure\Component\Http\Server\RequestHandlerInterface;

class AuthorizationMiddleware implements MiddlewareInterface
{

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // TODO: Implement process() method.
    }
}