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
     * @var string|null
    */
    protected ?string $method;



    /**
     * @var array
    */
    protected $body = [];



    /**
     * @var array
    */
    protected $headers = [];



    protected $options = [];




    public function __construct()
    {
    }

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
     * @param string $method
     *
     * @return $this
    */
    public function method(string $method): static
    {
        $this->method = $method;

        return $this;
    }




    /**
     * @param array $headers
     *
     * @return $this
    */
    public function headers(array $headers): static
    {
        foreach ($headers as $key => $value) {
            $this->header($key, $value);
        }

        return $this;
    }






    /**
     * @param string $key
     *
     * @param $value
     *
     * @return $this
    */
    public function header(string $key, $value): static
    {
          $this->headers[] = "$key: $value";

          return $this;
    }




    /**
     * @param array $cookies
     *
     * @return $this
    */
    public function cookies(array $cookies): static
    {
         if ($cookies) {
             $cookieParams = [];
             foreach ($cookies as $key => $value) {
                 $cookieParams[] = "$key=$value";
             }
             $this->header('Cookie', join(' ', $cookieParams));
         }

         return $this;
    }





    /**
     * @param array $data
     *
     * @return $this
    */
    public function body(array $data): static
    {
        $this->body = $data;

        return $this;
    }




    /**
     * @return string|null
    */
    public function getMethod(): ?string
    {
        return $this->method;
    }






    /**
     * @return Stream
    */
    public function create(): Stream
    {
        return Stream::createFromContext($this->url, 'r', $this->createResource());
    }






    /**
     * @return resource
    */
    public function createResource()
    {
        return stream_context_create([
            'http' => [
                'method'  => $this->method,
                'header'  => $this->headers,
                'content' => http_build_query($this->body)
            ]
        ]);
    }
}