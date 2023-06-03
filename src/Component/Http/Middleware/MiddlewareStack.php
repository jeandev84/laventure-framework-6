<?php
namespace Laventure\Component\Http\Middleware;


use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Response;

/**
 * @MiddlewareStack
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Middleware
*/
class MiddlewareStack
{

    /**
     * @var \Closure
    */
    protected $fallback;




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
            return $response;
        };

        return $this;
    }




    /**
     * @param Request $request
     *
     * @return void
    */
    public function handle(Request $request)
    {
        return call_user_func($this->fallback, $request);
    }
}