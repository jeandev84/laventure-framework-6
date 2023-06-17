<?php
namespace Laventure\Component\Http\Message\Middleware;

use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Server\RequestHandlerInterface;

class QueueRequestHandlerAdapter implements MiddlewareHandlerAdapter
{

    /**
     * @var QueueRequestHandler
    */
    protected $handler;



    /**
     * @param RequestHandlerInterface|null $fallbackHandler
    */
    public function __construct(RequestHandlerInterface $fallbackHandler = null)
    {
        $this->handler = new QueueRequestHandler($fallbackHandler);
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