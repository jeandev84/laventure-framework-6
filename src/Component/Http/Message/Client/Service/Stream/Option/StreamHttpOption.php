<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream\Option;

class StreamHttpOption implements StreamOptionInterface
{


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


    /**
     * @var array
    */
    protected $cookies = [];





    /**
     * @param string $method
     *
     * @param array $headers
     *
     * @param array $data
    */
    public function __construct(string $method, array $data = [], array $headers = [])
    {
        $this->method($method);
        $this->body($data);
        $this->headers($headers);
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
     * @inheritDoc
    */
    public function getOptions(): array
    {
         return [
             'http' => [
                 'method'  => $this->method,
                 'header'  => $this->headers,
                 'content' => http_build_query($this->body)
             ]
         ];
    }
}