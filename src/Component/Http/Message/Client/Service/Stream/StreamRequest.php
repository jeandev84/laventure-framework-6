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
         $headers    = $this->getResponseHeaders();
         [$version, $statusCode, $message] = $this->getHeadersInfo();

         $response =  new StreamResponse($content, $statusCode, $headers);
         $response->setProtocolVersion($version);
         $response->setReasonPhrase($message);

         return $response;
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
    public function getResponseHeaders(): array
    {
         $headersRows = $this->getHeaders();

         $headers = [];

         foreach ($headersRows as $header) {
             if(stripos($header, ':') !== false) {
                  [$name, $value] = explode(':', $header, 2);
                  $headers[$name] = $value;
             }
         }

         return $headers;
    }





    /**
     * @return array
    */
    public function getHeaders(): array
    {
         if(! $headers = get_headers($this->url)) {
             return [];
         }

         return $headers;
    }





    /**
     * @return array
    */
    public function getHeadersInfo(): array
    {
         $responseHeader = $this->getHeaders()[0];

         /*
         $responseHeader = $this->getHeaders()[0];
         $version      = substr($responseHeader, 0, 8);
         $statusCode   = substr($responseHeader, 9, 3);
         $message      = substr($responseHeader, 13);
         return [$version, $statusCode, $message];
         */

         return explode(' ', $responseHeader, 3);
    }




    /**
     * @param resource $context
     *
     * @return int
    */
    private function getResponseStatusCode($context): int
    {
        file_get_contents($this->url, false, $context);
        return substr($http_response_header[0], 9, 3);
    }

}