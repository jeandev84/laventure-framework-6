<?php
namespace Laventure\Component\Http\Message\Client\Service;

class cUrlInfo
{

    /**
     * @var string|false
    */
    protected $response;



    /**
     * @var \CurlHandle
    */
    protected \CurlHandle $ch;



    /**
     * @param \CurlHandle $ch
    */
    public function __construct(\CurlHandle $ch)
    {
        $this->ch       = $ch;
        $this->response = curl_exec($ch);
    }




    /**
     * @param $key
     *
     * @return mixed
    */
    public function get($key)
    {
        return curl_getinfo($this->ch, $key);
    }




    /**
     * @return mixed
    */
    public function all()
    {
         return curl_getinfo($this->ch);
    }



    /**
     * @return string|false
    */
    public function getResponse(): string|false
    {
        return $this->response;
    }




    /**
     * @return string|null
    */
    public function getBody(): ?string
    {
        return substr($this->getResponse(), $this->getHeaderSize());
    }





    /**
     * @return mixed
    */
    public function getHeaderSize()
    {
        return $this->get(CURLINFO_HEADER_SIZE);
    }





    /**
     * @return string
    */
    public function getHeaderString(): string
    {
        return substr($this->response, 0, $this->getHeaderSize());
    }





    /**
     * @return array
    */
    public function getHeaders(): array
    {
        $headerRows = explode(PHP_EOL, $this->getHeaderString());
        $headers = array_filter($headerRows, 'trim');

        return [];
    }




    /**
     * @return int
    */
    public function getStatusCode(): int
    {
        return $this->get(CURLINFO_HTTP_CODE);
    }




    public function __destruct()
    {
        curl_close($this->ch);
    }
}