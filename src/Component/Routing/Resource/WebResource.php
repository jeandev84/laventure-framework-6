<?php
namespace Laventure\Component\Routing\Resource;


use Laventure\Component\Routing\Resource\Contract\Resource;
use Laventure\Component\Routing\Router;


/**
 * @WebResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Resource
*/
class WebResource extends Resource
{

    /**
     * @inheritDoc
    */
    public function getResourceType(): string
    {
         return 'web';
    }





    /**
     * @inheritDoc
    */
    public function mapRoutes(Router $router): static
    {
         $this->addRoute($router->get($this->path(), $this->action('index')));
         $this->addRoute($router->get($this->path("/{id}"), $this->action('show')));
         $this->addRoute($router->get($this->path(), $this->action('create')));
         $this->addRoute($router->post($this->path(), $this->action('store')));
         $this->addRoute($router->get($this->path("/{id}/edit"), $this->action('edit')));
         $this->addRoute($router->map('PUT|PATCH', $this->path("/{id}"), $this->action('update')));
         $this->addRoute($router->delete($this->path("/{id}"), $this->action('destroy')));


         return $this;
    }
}