<?php
namespace Laventure\Component\Http\Message\Client;


use Laventure\Component\Http\Message\Client\Contract\HttpClientInterface;
use Laventure\Component\Http\Message\Request\Contract\RequestInterface;
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
     * @inheritDoc
     */
    public function sendRequest(RequestInterface $request, array $options = []): ResponseInterface
    {

    }



    /**
     * @inheritDoc
    */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        // TODO: Implement request() method.
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