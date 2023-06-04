<?php
namespace Laventure\Component\Http\Message\Client;

use Laventure\Component\Http\Bag\ClientParameterBag;
use Laventure\Component\Http\Message\Request\Request;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Component\Http\Message\Client\Service\cURL;
use Laventure\Component\Http\Message\Request\Contract\RequestInterface;
use Laventure\Component\Http\Message\Request\Uri;
use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;


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
     * @var ClientParameterBag
    */
    private $parameter;




    /**
     * HttpClient constructor.
    */
    public function __construct()
    {
        $this->parameter = new ClientParameterBag();
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
         $curl       = new cURL($request->getUrl());
         $statusCode = 200;

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
         $request = Request::createFromGlobals();
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