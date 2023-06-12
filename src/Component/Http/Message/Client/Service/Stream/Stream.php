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
     * @inheritdoc
    */
    public function getSize(): int
    {
        if (is_file($this->resource)) {
            return filesize($this->resource);
        }

        return parent::getSize();
    }
}