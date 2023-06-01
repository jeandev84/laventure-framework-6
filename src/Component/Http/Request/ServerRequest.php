<?php
namespace Laventure\Component\Http\Request;

use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Request\Bag\ParsedBodyBag;
use Laventure\Component\Http\Request\Body\ParsedBody;
use Laventure\Component\Http\Request\Body\RequestBody;
use Laventure\Component\Http\Message\StreamInterface;
use Laventure\Component\Http\Request\Bag\CookieBag;
use Laventure\Component\Http\Request\Bag\FileBag;
use Laventure\Component\Http\Request\Bag\InputBag;
use Laventure\Component\Http\Request\Bag\RequestHeaderBag;
use Laventure\Component\Http\Request\Bag\ServerBag;
use Laventure\Component\Http\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Request\Contract\UriInterface;


/**
 * @ServerRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request
*/
class ServerRequest implements ServerRequestInterface
{

    /**
     * get query params from $_GET
     *
     * @var ParameterBag
     */
    public $queries;




    /**
     * get params from request $_POST
     *
     * @var ParameterBag
     */
    public $request;




    /**
     * get request attributes
     *
     * @var ParameterBag
    */
    public $attributes;



    /**
     * get data from $_COOKIE
     *
     * @var CookieBag
     */
    public $cookies;




    /**
     * get data from $_FILES
     *
     * @var FileBag
     */
    public $files;




    /**
     * get data from $_SERVER
     *
     * @var ServerBag
     */
    public $server;




    /**
     * HTTP headers from $_SERVER
     *
     * @var RequestHeaderBag
     */
    public $headers;




    /**
     * Content
     *
     * @var string
    */
    protected $content;




    /**
     * Request body
     *
     * @var StreamInterface
    */
    protected $body;





    /**
     * Request URL
     *
     * @var string
    */
    protected $target;




    /**
     * HTTP Protocol
     *
     * @var string
     */
    protected $protocol;




    /**
     * Request method
     *
     * @var string
     */
    protected $method;



    /**
     * Request uri object
     *
     * @var UriInterface
    */
    protected UriInterface $url;




    /**
     * @param array $queries
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @return void
    */
    public function __construct(
        array $queries = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
    ) {
        $this->queries    =  new InputBag($queries);
        $this->request    =  new InputBag($request);
        $this->attributes =  new ParameterBag($attributes);
        $this->cookies    =  new CookieBag($cookies);
        $this->files      =  new FileBag($files);
        $this->server     =  new ServerBag($server);
        $this->url        =  new Uri($this->server->getURL());
        $this->headers    =  new RequestHeaderBag();
        $this->body       =  new RequestBody();
        $this->target     =  $this->server->getRequestUri();
        $this->protocol   =  $this->server->getProtocolVersion();
        $this->method     =  $this->server->getRequestMethod();
    }



    /**
     * @inheritDoc
     */
    public function getServerParams(): array
    {
        return $this->server->all();
    }





    /**
     * @inheritDoc
     */
    public function getCookieParams(): array
    {
        return $this->cookies->all();
    }





    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies): static
    {
        $this->cookies->merge($cookies);

        return $this;
    }



    /**
     * @inheritDoc
     */
    public function getQueryParams(): array
    {
        return $this->queries->all();
    }





    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query): static
    {
        $this->queries->merge($query);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getUploadedFiles(): array
    {
        return $this->files->all();
    }




    /**
     * @inheritDoc
    */
    public function withUploadedFiles(array $uploadedFiles): static
    {
        $this->files->merge($uploadedFiles);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getParsedBody()
    {
        $parsedBody = new ParsedBody();

        if ($this->headers->formEncoded()) {
            if (!$parsedBody->isEmpty() && $this->inAllowedFormMethods()) {
                 $this->request = new InputBag($parsedBody->getData());
            }
            return $this->request;
        }

        if (! $this->inAllowedResourceMethods()) {
             return new InputBag();
        }

        return new InputBag($parsedBody->asArray());
    }





    /**
     * @inheritDoc
    */
    public function withParsedBody($data): static
    {
        $this->request->merge($data);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getAttributes(): array
    {
        return $this->attributes->all();
    }




    /**
     * @inheritDoc
     */
    public function getAttribute($name, $default = null): mixed
    {
        return $this->attributes->get($name, $default);
    }




    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value): static
    {
        $this->attributes->set($name, $value);

        return $this;
    }





    /**
     * @param array $attributes
     *
     * @return $this
     */
    public function withAttributes(array $attributes): static
    {
        $this->attributes->merge($attributes);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function withoutAttribute($name): static
    {
        $this->attributes->remove($name);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->server->getProtocolVersion();
    }




    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version): static
    {
        $this->server->set('SERVER_PROTOCOL', $version);

        return $this;
    }






    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {
        return $this->headers->all();
    }




    /**
     * @inheritDoc
     */
    public function hasHeader($name): bool
    {
        return $this->headers->has($name);
    }




    /**
     * @inheritDoc
     */
    public function getHeader($name): mixed
    {
        return $this->headers->get($name);
    }




    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        // TODO implements
    }




    /**
     * @inheritDoc
     */
    public function withHeader($name, $value): static
    {
        $this->headers->set($name, $value);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value): static
    {
        if ($this->headers->has($name)) {
            $this->headers->set($name, $value);
        }

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function withoutHeader($name): static
    {
        $this->headers->remove($name);

        return $this;
    }



    /**
     * @inheritDoc
     */
    public function getBody(): StreamInterface
    {
        return $this->body;
    }




    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body): static
    {
        $this->body = $body;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function url(): string
    {
        return $this->server->getURL();
    }



    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget): static
    {
        $this->target = $requestTarget;

        return $this;
    }



    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return $this->method;
    }



    /**
     * @inheritDoc
     */
    public function withMethod($method): static
    {
        $this->method = strtoupper($method);

        $this->server->set('REQUEST_METHOD', $this->method);

        return $this;
    }




    /**
     * @return string
    */
    public function getHost(): string
    {
        return $this->server->getHost();
    }





    /**
     * @inheritDoc
     */
    public function getUrl(): UriInterface
    {
        return $this->url;
    }




    /**
     * @inheritDoc
    */
    public function withUri(UriInterface $uri, $preserveHost = false): static
    {
        if ($preserveHost) {
            $uri->withHost($this->getHost());
        }

        $this->url = $uri;

        return $this;
    }



    /**
     * @param string $name
     *
     * @return bool
    */
    public function isMethod(string $name): bool
    {
         return $this->server->isMethod($name);
    }




    /**
     * @return bool
    */
    public function inAllowedFormMethods(): bool
    {
        return in_array($this->getMethod(), ['PUT', 'DELETE', 'PATCH']);
    }




    /**
     * @return bool
    */
    public function inAllowedResourceMethods(): bool
    {
        return in_array($this->getMethod(), ['POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS']);
    }
}