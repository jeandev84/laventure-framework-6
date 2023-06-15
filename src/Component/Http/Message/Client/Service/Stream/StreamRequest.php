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
        $this->options = array_merge($this->options, $option->getParameters());

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
         $stream     = $this->create();
         $content    = $stream->getContents();
         $statusCode = 200;
         $headers    = $this->getHeaders();
         return new StreamResponse($content, $statusCode, $headers);
    }






    /**
     * @return Stream
    */
    public function create(): Stream
    {
        return Stream::createFromContext($this->url, 'r', $this->options);
    }




    /**
     * @param string $url
     *
     * @param StreamOptionInterface[] $options
     *
     * @return StreamResponse
    */
    public function request(string $url, array $options = []): StreamResponse
    {
        $request = new static();
        $request->url($url);
        $request->addOptions($options);
        return $request->send();
    }






    /**
     * @return array
    */
    public function getOptions(): array
    {
        return $this->options;
    }






    /**
     * @return string|null
    */
    public function getUrl(): ?string
    {
        return $this->url;
    }




    /**
     * @return array
    */
    public function getHeaders(): array
    {
         $headersRows = get_headers($this->url);

         $headers = [];

         foreach ($headersRows as $header) {
             if(stripos($header, ':') !== false) {
                  [$name, $value] = explode(':', $header, 2);
                  $headers[$name] = $value;
             }
         }

         return $headers;
    }
}