<?php
namespace Laventure\Component\Templating;

use Laventure\Component\Templating\Extension\TemplateExtensionInterface;

/**
 * @Template
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating
*/
class Template implements TemplateInterface
{


    /**
     * @var TemplateExtensionInterface[]
    */
    protected $extensions = [];




    /**
     * Template constructor
     *
     * @param string $path
     *
     * @param array $parameters
    */
    public function __construct(protected string $path, protected array $parameters = [])
    {

    }



    /**
     * @param TemplateExtensionInterface $extension
     *
     * @return $this
    */
    public function addExtension(TemplateExtensionInterface $extension): static
    {
        $this->extensions[] = $extension;

        return $this;
    }




    /**
     * Returns all extension
     *
     * @return TemplateExtensionInterface[]
    */
    public function getExtensions(): array
    {
        return $this->extensions;
    }




    /**
     * @inheritDoc
    */
    public function getPath(): string
    {
        return $this->path;
    }



    /**
     * @inheritDoc
    */
    public function getParameters(): array
    {
        return $this->parameters;
    }




    /**
     * @return string
    */
    public function getContent(): string
    {
        extract($this->parameters, EXTR_SKIP);
        ob_start();
        @require_once realpath($this->path);
        return ob_get_clean();
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
         return $this->getContent();
    }
}