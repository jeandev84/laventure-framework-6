<?php
namespace Laventure\Component\Http\Request;

use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Message\StreamInterface;
use Laventure\Component\Http\Request\Bag\CookieBag;
use Laventure\Component\Http\Request\Bag\FileBag;
use Laventure\Component\Http\Request\Bag\ServerBag;
use Laventure\Component\Http\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Request\Contract\UriInterface;


/**
 * @Request
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request
*/
class Request  implements ServerRequestInterface
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
     * @param array $queries
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     */
    public function __construct(
        array $queries = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = []
    )
    {
        $this->queries    =  new ParameterBag($queries);
        $this->request    =  new ParameterBag($request);
        $this->attributes =  new ParameterBag($attributes);
        $this->cookies    =  new CookieBag($cookies);
        $this->files      =  new FileBag($files);
        $this->server     =  new ServerBag($server);
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
    public function withCookieParams(array $cookies)
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
    public function withQueryParams(array $query)
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
    public function withUploadedFiles(array $uploadedFiles)
    {
        $this->files->merge($uploadedFiles);

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getParsedBody()
    {
        return $this->request->all();
    }




    /**
     * @inheritDoc
     */
    public function withParsedBody($data)
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
    public function getAttribute($name, $default = null)
    {
        return $this->attributes->get($name, $default);
    }




    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value)
    {
        $this->attributes->set($name, $value);

        return $this;
    }





    /**
     * @param array $attributes
     * @return void
     */
    public function withAttributes(array $attributes)
    {
        $this->attributes->merge($attributes);
    }




    /**
     * @inheritDoc
    */
    public function withoutAttribute($name)
    {
        $this->attributes->remove($name);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        // TODO: Implement getMethod() method.
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method)
    {
        // TODO: Implement withMethod() method.
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        // TODO: Implement getUri() method.
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        // TODO: Implement withUri() method.
    }
}