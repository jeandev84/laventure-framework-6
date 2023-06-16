<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream;

use Laventure\Component\Http\Message\Client\ClientRequest;
use Laventure\Component\Http\Message\Client\ClientResponseInterface;
use Laventure\Component\Http\Message\Client\Service\Stream\Option\StreamFtpOption;
use Laventure\Component\Http\Message\Client\Service\Stream\Option\StreamHttpOption;
use Laventure\Component\Http\Message\Client\Service\Stream\Option\StreamOptionInterface;


class StreamRequest extends ClientRequest
{

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
         if (! $this->url) {
              return new StreamResponse();
         }

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
     * @inheritDoc
    */
    public function request(string $method, string $url, array $context = []): ClientResponseInterface
    {
        $request = new static();
        $request->url($url);
        $request->addHttpOptions($method, $context)
                ->addFtpOptions($context);

        return $request->send();
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
     * @param resource $context
     *
     * @return int
    */
    private function getResponseStatusCode($context): int
    {
        file_get_contents($this->url, false, $context);
        return substr($http_response_header[0], 9, 3);
    }




    /**
     * @param string $method
     * @param array $options
     *
     * @return $this
     */
    private function addHttpOptions(string $method, array $options): static
    {
        if (isset($options['http'])) {

            $context = $options['http'];
            $context['method'] = $method;

            $this->addOption(StreamHttpOption::createFromArray($context));
        }

        return $this;
    }



    /**
     * @param array $options
     *
     * @return $this
    */
    private function addFtpOptions(array $options): static
    {
         if (isset($options['ftp'])) {
               $this->addOption(StreamFtpOption::createFromArray($options['ftp']));
         }

         return $this;
    }
}