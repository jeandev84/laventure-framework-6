<?php
namespace Laventure\Component\Http\Message\Client;


use Laventure\Component\Http\Message\Client\Contract\HttpClientInterface;
use Laventure\Component\Http\Message\Client\Service\cUrl\cUrlRequest;
use Laventure\Component\Http\Message\Request\Contract\RequestInterface;
use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;
use Laventure\Component\Http\Message\Response\Response;

/**
 * @HttpClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client\HttpClient
*/
class HttpClient implements HttpClientInterface
{

    /**
     * @var array
    */
    protected $options = [];




    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
         $curlRequest = new cUrlRequest();
         $curlResponse = $curlRequest->request($request->getMethod(), $request->url(), $this->options);

         return new Response($curlResponse->getBody(), $curlResponse->getStatusCode(), $curlResponse->getHeaders());
    }




    /**
     * @inheritDoc
    */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
         $this->options = $options;

         $request = Request::create($url, $method);

         return $this->sendRequest($request);
    }




    /**
     * @inheritDoc
    */
    public function get(string $url, array $options = []): ResponseInterface
    {
        return $this->request($url, 'GET', $options);
    }




    /**
     * @inheritDoc
    */
    public function post(string $url, array $options = []): ResponseInterface
    {
        return $this->request($url, 'POST', $options);
    }



    /**
     * @inheritDoc
    */
    public function put(string $url, array $options = []): ResponseInterface
    {
        return $this->request($url, 'PUT', $options);
    }





    /**
     * @inheritDoc
    */
    public function patch(string $url, array $options = []): ResponseInterface
    {
        return $this->request($url, 'PATCH', $options);
    }




    /**
     * @inheritDoc
    */
    public function delete(string $url, array $options = []): ResponseInterface
    {
        return $this->request($url, 'DELETE', $options);
    }
}