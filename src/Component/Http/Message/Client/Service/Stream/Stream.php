<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream;

use Laventure\Component\Http\Message\Stream\Stream as StreamResource;


class Stream extends StreamResource
{

    protected $resource;



    /**
     * @param $resource
     *
     * @param string|null $accessMode
    */
    public function __construct($resource, string $accessMode = null)
    {
        parent::__construct($resource, $accessMode);
        $this->resource = $resource;
    }




    /**
     * @return bool
    */
    public function isFileResource(): bool
    {
        return is_file($this->resource);
    }




    /**
     * @param $content
     *
     * @return bool|int
    */
    public function put($content): bool|int
    {
        if (! $this->isFileResource()) {
             return false;
        }

        return file_put_contents($this->resource, $content);
    }




    /**
     * @return bool
    */
    public function touch(): bool
    {
        if (! is_string($this->resource)) {
             return false;
        }

        $dirname = dirname($this->resource);

        if (! is_dir($dirname)) {
            @mkdir($dirname, 0777, true);
        }

        return touch($this->resource);
    }




    /**
     * @return false|string
    */
    public function get(): bool|string
    {
         if (! $this->isFileResource()) {
              return '';
         }

         return file_get_contents($this->resource);
    }




    /**
     * @inheritdoc
    */
    public function getSize(): int
    {
        if ($this->isFileResource()) {
            return filesize($this->resource);
        }

        return parent::getSize();
    }
}