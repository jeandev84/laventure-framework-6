<?php
namespace Laventure\Component\Http\Client;

use Laventure\Component\Http\Bag\clientParameterBag;
use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Client\Service\cURL;
use Laventure\Component\Http\Request\Contract\RequestInterface;
use Laventure\Component\Http\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Request\Request;
use Laventure\Component\Http\Request\Uri;
use Laventure\Component\Http\Response\Contract\ResponseInterface;
use Laventure\Component\Http\Response\Response;


/**
 * @HttpClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\HttpClient
*/
class HttpClient implements HttpClientInterface
{


    /**
     * @var ClientParameterBag
    */
    private $parameter;




    /**
     * HttpClient constructor.
    */
    public function __construct()
    {
        $this->parameter = new clientParameterBag();
    }




    /**
     * @param string $method
     *
     * @param string $url
     *
     * @param array $context
     *
     * @return Response
    */
    public static function create(string $method, string $url, array $context = []): Response
    {
          return new Response();
    }





    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
         $curl = new cURL($request->getUrl());
         $curl->setOptions($this->parameter->all());

         $response = new Response($curl->exec());
         $response->withProtocolVersion($request->getProtocolVersion());
         $response->send();

         return $response;
    }





    /**
     * @inheritDoc
    */
    public function send(string $method, string $url, array $options = []): ResponseInterface
    {
         $request = new Request();
         $request->withMethod($method);
         $request->withUri(new Uri($url));
         $this->parameter->merge($options);

         return $this->sendRequest($request);
    }






    /**
     * @inheritDoc
    */
    public function get(string $url, array $options = []): ResponseInterface
    {
        // TODO: Implement get() method.
    }



    /**
     * @inheritDoc
    */
    public function post(string $url, array $options = []): ResponseInterface
    {
        // TODO: Implement post() method.
    }



    /**
     * @inheritDoc
    */
    public function put(string $url, array $options = []): ResponseInterface
    {
        // TODO: Implement put() method.
    }



    /**
     * @inheritDoc
    */
    public function patch(string $url, array $options = []): ResponseInterface
    {
        // TODO: Implement patch() method.
    }




    /**
     * @inheritDoc
    */
    public function delete(string $url, array $options = []): ResponseInterface
    {
        // TODO: Implement delete() method.
    }
}