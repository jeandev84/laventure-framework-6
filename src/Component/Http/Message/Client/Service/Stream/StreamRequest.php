<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream;

use Laventure\Component\Http\Message\Client\Service\Stream\Option\StreamOptionInterface;

class StreamRequest
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
     * @return $this
    */
    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }





    /**
     * @param StreamOptionInterface $option
     *
     * @return $this
    */
    public function addOption(StreamOptionInterface $option): static
    {
        $this->options = array_merge($this->options, $option->getOptions());

        return $this;
    }





    /**
     * @param StreamOptionInterface[] $options
     *
     * @return $this
    */
    public function addOptions(array $options): static
    {
        foreach ($options as $option) {
            $this->addOption($option);
        }

        return $this;
    }



    /**
     * @return StreamResponse
    */
    public function send(): StreamResponse
    {
         $context = new StreamContext($this->url, $this->options);
         $stream  = $context->create();

         return new StreamResponse();
    }





//    /**
//     * @return Stream
//    */
//    public function create(): Stream
//    {
//        $context = stream_context_create($this->options);
//
//        return Stream::createFromContext($this->url, 'r', $context);
//    }
}