<?php
namespace Laventure\Component\Http\Message\Middleware;


use Laventure\Component\Http\Message\Middleware\Handler\NotFoundHandler;
use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;
use Laventure\Component\Http\Server\MiddlewareInterface;
use Laventure\Component\Http\Server\RequestHandlerInterface;


/**
 * @QueueRequestHandler
 *
 * @see https://www.php-fig.org/psr/psr-15/meta/
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Middleware
*/
class QueueRequestHandler implements RequestHandlerInterface
{

    /**
     * @var array
    */
    protected $middlewares = [];


    /**
     * @var RequestHandlerInterface
    */
    protected $fallbackHandler;


    /**
     * @param RequestHandlerInterface|null $fallbackHandler
    */
    public function __construct(RequestHandlerInterface $fallbackHandler = null)
    {
        $this->fallbackHandler = $fallbackHandler ?: new NotFoundHandler();
    }




    /**
     * @param MiddlewareInterface $middleware
     *
     * @return $this;
    */
    public function add(MiddlewareInterface $middleware): static
    {
        $this->middlewares[] = $middleware;

        return $this;
    }




    /**
     * @return array
    */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }




    /**
     * @inheritDoc
    */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Last middleware in the queue has called on the request handler.
        if (0 === count($this->middlewares)) {
            return $this->fallbackHandler->handle($request);
        }

        $middleware = array_shift($this->middlewares);
        return $middleware->process($request, $this);
    }
}


/*
// Fallback handler:
$fallbackHandler = new NotFoundHandler();

// Create request handler instance:
$app = new QueueRequestHandler($fallbackHandler);

// Add one or more middleware:
$app->add(new AuthorizationMiddleware());
$app->add(new RoutingMiddleware());

// execute it:
$response = $app->handle(ServerRequestFactory::fromGlobals());
*/