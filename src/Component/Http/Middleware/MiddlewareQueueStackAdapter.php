<?php
namespace Laventure\Component\Http\Middleware;

use Laventure\Component\Http\Message\Middleware\MiddlewareHandlerAdapter;
use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;

class MiddlewareQueueStackAdapter implements MiddlewareHandlerAdapter
{

    /**
     * @var MiddlewareQueueStack
    */
    protected $handler;


    public function __construct()
    {
        $this->handler = new MiddlewareQueueStack();
    }




    /**
     * @inheritDoc
    */
    public function addMiddleware($middleware): mixed
    {
        $this->handler->add($middleware);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function handle(ServerRequestInterface $request)
    {
         $this->handler->handle($request);
    }





    /**
     * @inheritDoc
    */
    public function getMiddlewares(): array
    {
        return $this->handler->getMiddlewares();
    }
}