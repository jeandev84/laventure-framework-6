<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream\Option;

class StreamFtpOption implements StreamOptionInterface
{
    /**
     * @var string|null
    */
    protected ?string $proxy;


    /**
     * @var bool
    */
    protected bool $uri = false;



    /**
     * @var array
     */
    protected array $headers = [];



    /**
     * @param string $proxy
     *
     * @param string $uri
     *
     * @param array $headers
    */
    public function __construct(string $proxy, string $uri, array $headers = [])
    {
        $this->proxy   = $proxy;
        $this->uri     = $uri;
        $this->headers = $headers;
    }





     /**
      * @inheritDoc
     */
     public function getParameters(): array
     {
         return [
            'ftp' => [
                'proxy' => $this->proxy,
                'request_fulluri' => $this->uri,
                'header' => []
            ]
         ];
     }
}