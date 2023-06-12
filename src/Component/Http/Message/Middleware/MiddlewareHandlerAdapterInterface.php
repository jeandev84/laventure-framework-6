<?php
namespace Laventure\Component\Http\Message\Middleware;

use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;

interface MiddlewareHandlerAdapterInterface
{
    /**
     * @param $middleware
     *
     * @return mixed
    */
    public function addMiddleware($middleware): mixed;



    /**
     * @param ServerRequestInterface $request
     *
     * @return mixed
    */
    public function handle(ServerRequestInterface $request);





    /**
     * @return array
    */
    public function getMiddlewares(): array;
}