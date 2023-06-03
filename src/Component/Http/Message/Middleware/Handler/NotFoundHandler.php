<?php
namespace Laventure\Component\Http\Message\Middleware\Handler;

use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Component\Http\Server\RequestHandlerInterface;


/**
 * @NotFoundHandler
 *
 * @see https://www.php-fig.org/psr/psr-15/meta/
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Middleware\Handler
*/
class NotFoundHandler implements RequestHandlerInterface
{

    /**
     * @inheritDoc
    */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
         return new Response();
    }
}