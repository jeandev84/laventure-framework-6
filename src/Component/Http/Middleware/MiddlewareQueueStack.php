<?php
namespace Laventure\Component\Http\Middleware;


use Closure;
use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Response;

/**
 * @MiddlewareQueueStack
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Middleware
*/
class MiddlewareQueueStack
{

    /**
     * @var Closure
    */
    protected $fallback;



    /**
     * @var Middleware[]
    */
    protected $middlewares = [];



    public function __construct()
    {
        $this->fallback = function () {
             return '';
        };
    }





    /**
     * @param Middleware $middleware
     *
     * @return $this
    */
    public function add(Middleware $middleware): static
    {
        $next = $this->fallback;

        $this->fallback = function (Request $request) use ($middleware, $next) {
            $response = $middleware->handle($request, $next);
            $middleware->terminate($request, $response);
            $this->middlewares[] = $middleware;
            return $next($request);
        };

        return $this;
    }




    /**
     * @return Middleware[]
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }





    /**
     * @param Request $request
     *
     * @return Response
    */
    public function handle(ServerRequestInterface $request): Response
    {
        return call_user_func($this->fallback, $request);
    }
}