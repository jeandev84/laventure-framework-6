<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream;

use Laventure\Component\Http\Message\Client\Service\Stream\Option\StreamOptionInterface;

class StreamRequest
{


    /**
     * @var array
    */
    protected $options = [];




    /**
     * @param StreamOptionInterface $option
     *
     * @return $this
    */
    public function addOption(StreamOptionInterface $option): static
    {
        $this->options[] = $option->getOptions();

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
     * @param string $method
     * @param string $url
     * @param array $options
     * @return StreamResponse
    */
    public function request(string $method, string $url, array $options = []): StreamResponse
    {
         #$http = new StreamHttpOption($options['http'] ?? []);

         $context = new StreamContext();
         $context->url($url);
         $context->method($method);
         $context->headers($options['headers'] ?? []);
         $context->body($options['body'] ?? []);
         $context->cookies($options['cookies'] ?? []);
         $stream  = $context->create();

         return new StreamResponse();
    }





    /**
     * @param string $method
     *
     * @return Stream
    */
    private function createStreamByMethod(string $method): Stream
    {

    }
}