<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream;

use Laventure\Component\Http\Message\Client\Service\Stream\Option\StreamOptionInterface;

class StreamContext
{


    /**
     * @var string|null
    */
    protected ?string $url;


    /**
     * @var array
    */
    protected $options = [];



    /**
     * @param string $url
     *
     * @param array $options
    */
    public function __construct(string $url, array $options)
    {
        $this->url     = $url;
        $this->options = $options;
    }



    /**
     * @return Stream
    */
    public function create(): Stream
    {
        $context = stream_context_create($this->options);

        return Stream::createFromContext($this->url, 'r', $context);
    }



    public function getBody()
    {
         return '';
    }
}