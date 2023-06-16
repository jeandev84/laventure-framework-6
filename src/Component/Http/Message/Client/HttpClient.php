<?php
namespace Laventure\Component\Http\Message\Client;


use Laventure\Component\Http\Message\Client\Contract\HttpClientInterface;
use Laventure\Component\Http\Message\Client\Exception\ClientExceptionInterface;
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
     * @var string|null
    */
    protected ?string $name;



    /**
     * @var array
    */
    protected $options = [];



    public function __construct()
    {
        $this->use(ClientRequestType::CURL);
    }



    /**
     * @param string $name
     *
     * @return $this
    */
    public function use(string $name): static
    {
         $this->name = $name;

         return $this;
    }



    /**
     * @param array $options
     *
     * @return $this
    */
    public function addOptions(array $options): static
    {
         $this->options = $options;

         return $this;
    }





    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {

            $clientRequest  = ClientRequestFactory::create($this->name);
            $clientResponse = $clientRequest->request($request->getMethod(), $request->url(), $this->options);

            return new Response($clientResponse->getBody(), $clientResponse->getStatusCode(), $clientResponse->getHeaders());

        } catch (\Exception $e) {

            throw new ClientException($e->getMessage(), $e->getCode());
        }
    }




    /**
     * @inheritDoc
     *
     * @throws ClientExceptionInterface
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
         return $this->addOptions($options)
                     ->sendRequest(Request::create($url, $method));
    }




    /**
     * @inheritDoc
     *
     * @throws ClientExceptionInterface
     */
    public function get(string $url, array $options = []): ResponseInterface
    {
        return $this->request('GET', $url, $options);
    }


    /**
     * @inheritDoc
     *
     * @throws ClientExceptionInterface
    */
    public function post(string $url, array $options = []): ResponseInterface
    {
        return $this->request( 'POST', $url, $options);
    }


    /**
     * @inheritDoc
     *
     * @throws ClientExceptionInterface
     */
    public function put(string $url, array $options = []): ResponseInterface
    {
        return $this->request('PUT', $url, $options);
    }




    /**
     * @inheritDoc
     *
     * @throws ClientExceptionInterface
    */
    public function patch(string $url, array $options = []): ResponseInterface
    {
        return $this->request('PATCH', $url, $options);
    }




    /**
     * @inheritDoc
     *
     * @throws ClientExceptionInterface
     */
    public function delete(string $url, array $options = []): ResponseInterface
    {
        return $this->request('DELETE', $url, $options);
    }
}