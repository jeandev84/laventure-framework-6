<?php
namespace Laventure\Component\Routing\Route\Resource;


use Laventure\Component\Routing\Route\Resource\Contract\Resource;
use Laventure\Component\Routing\Router;


/**
 * @WebResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Resource
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
         $this->addRoute($router->get("/$this->name", $this->action('index')));
         $this->addRoute($router->get("/$this->name/{id}", $this->action('show')));
         $this->addRoute($router->get("/$this->name", $this->action('create')));
         $this->addRoute($router->post("/$this->name", $this->action('store')));
         $this->addRoute($router->get("/$this->name/{id}/edit", $this->action('edit')));
         $this->addRoute($router->map('PUT|PATCH', "/$this->name/{id}", $this->action('update')));
         $this->addRoute($router->delete("/$this->name/{id}", $this->action('destroy')));


         return $this;
    }
}