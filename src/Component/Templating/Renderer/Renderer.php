<?php
namespace Laventure\Component\Templating\Renderer;


use Laventure\Component\Templating\Cache\TemplateCache;
use Laventure\Component\Templating\Cache\TemplateCacheInterface;
use Laventure\Component\Templating\Template;


/**
 * @Renderer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Renderer
*/
class Renderer implements RendererInterface
{

    /**
     * @var string
    */
    protected $resource;



    /**
     * @var TemplateCacheInterface
    */
    protected $cache;




    /**
     * Renderer constructor
     *
     * @param $resource
    */
    public function __construct($resource)
    {
         $this->resource($resource);
         $this->cache(new TemplateCache($resource));
    }




    /**
     * Set renderer resource path
     *
     * @param string $resource
     *
     * @return $this
    */
    public function resource(string $resource): static
    {
        $this->resource = realpath(rtrim($resource, DIRECTORY_SEPARATOR));

        return $this;
    }




    /**
     * @param TemplateCacheInterface $cache
     *
     * @return $this
    */
    public function cache(TemplateCacheInterface $cache): static
    {
         $this->cache = $cache;

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function render(string $template, array $data = [])
    {
        return new Template($this->path($template), $data);
    }





    /**
     * @param string $path
     *
     * @return string
    */
    public function path(string $path): string
    {
        return join(DIRECTORY_SEPARATOR, [$this->resource, trim($path, DIRECTORY_SEPARATOR)]);
    }
}