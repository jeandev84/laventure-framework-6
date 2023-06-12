<?php
namespace Laventure\Component\Http\Message\Client\cUrl\Service;

class cUrlInfo
{


    /**
     * @var string|false
    */
    protected $response;



    /**
     * @param \CurlHandle $ch
    */
    public function __construct(protected \CurlHandle $ch)
    {
    }




    /**
     * @param string|false $response
    */
    public function setResponse(string|false $response): void
    {
        $this->response = $response;
    }




    /**
     * @return string|false
    */
    public function getResponse(): string|false
    {
        return $this->response;
    }
}