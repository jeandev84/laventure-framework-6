<?php
namespace Laventure\Component\Http\Message\Middleware;

use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;


class MiddlewareQueueHandler
{

     /**
      * @param MiddlewareHandlerAdapter $adapter
     */
     public function __construct(protected MiddlewareHandlerAdapter $adapter)
     {
     }



     /**
      * @param $middleware
      *
      * @return $this
     */
     public function addMiddleware($middleware): static
     {
         $this->adapter->addMiddleware($middleware);

         return $this;
     }




    /**
     * @param ServerRequestInterface $request
     *
     * @return void
    */
    public function handle(ServerRequestInterface $request)
    {
        $this->adapter->handle($request);
    }
}