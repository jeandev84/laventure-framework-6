<?php
namespace Laventure\Component\Routing\Resource;


use Laventure\Component\Routing\Resource\Contract\Resource;
use Laventure\Component\Routing\Router;

/**
 * @ApiResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Resource
*/
class ApiResource extends Resource
{

    /**
     * @inheritDoc
    */
    public function mapRoutes(Router $router): static
    {
        $this->addRoute($router->get($this->path(), $this->action('index')));
        $this->addRoute($router->get($this->path("/{id}"), $this->action('show')));
        $this->addRoute($router->post($this->path(), $this->action('store')));
        $this->addRoute($router->map('PUT|PATCH', $this->path("/{id}"), $this->action('update')));
        $this->addRoute($router->delete($this->path("/{id}"), $this->action('destroy')));

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getTypeName(): string
    {
         return 'api';
    }
}