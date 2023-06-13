<?php
namespace Laventure\Component\Http\Message\Stream;

class StreamFactory
{


    /**
     * @param $resource
     *
     * @param string|null $accessMode
     *
     * @return Stream
    */
    public static function create($resource, string $accessMode = null): Stream
    {
        return new Stream($resource, $accessMode);
    }
}