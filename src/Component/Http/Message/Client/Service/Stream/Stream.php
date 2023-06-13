<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream;

use Laventure\Component\Http\Message\Stream\Stream as StreamResource;


class Stream extends StreamResource
{

    protected $resource;



    /**
     * @var string
    */
    protected $path;




    /**
     * @param $resource
     *
     * @param string|null $accessMode
    */
    public function __construct($resource, string $accessMode = null)
    {
        parent::__construct($resource, $accessMode);
    }




    /**
     * @param $content
     *
     * @return bool|int
    */
    public function put($content): bool|int
    {
        return file_put_contents($this->getPath(), $content);
    }




    /**
     * @return bool
    */
    public function touch(): bool
    {
        $file    = $this->getPath();
        $dirname = dirname($file);

        if (! is_dir($dirname)) {
            @mkdir($dirname, 0777, true);
        }

        return touch($file);
    }




    /**
     * @return false|string
    */
    public function get(): bool|string
    {
         if (! $this->isFromFile()) {
              return '';
         }

         return file_get_contents($this->resource);
    }




    /**
     * @inheritdoc
    */
    public function getSize(): int
    {
        if ($this->isFromFile()) {
            return filesize($this->getPath());
        }

        return parent::getSize();
    }



    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }




    /**
     * @return string|null
    */
    public function getPath(): ?string
    {
        return $this->path;
    }



    /**
     * @return bool
    */
    public function isFromFile(): bool
    {
        return is_file($this->path);
    }
}