<?php
namespace Laventure\Component\Http\Request;

use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Body\RequestBody;
use Laventure\Component\Http\Message\StreamInterface;
use Laventure\Component\Http\Request\Bag\CookieBag;
use Laventure\Component\Http\Request\Bag\FileBag;
use Laventure\Component\Http\Request\Bag\InputBag;
use Laventure\Component\Http\Request\Bag\RequestHeaderBag;
use Laventure\Component\Http\Request\Bag\ServerBag;
use Laventure\Component\Http\Request\Contract\ServerRequestInterface;
use Laventure\Component\Http\Request\Contract\UriInterface;
use Laventure\Component\Http\Storage\Session\SessionInterface;
use Laventure\Component\Http\Storage\Session\Session;


/**
 * @Request
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request
*/
class Request  extends ServerRequest
{



    /**
     * session data $_SESSION
     *
     * @var SessionInterface
    */
    public $session;



    /**
     * @param array $queries
     *
     * @param array $request
     *
     * @param array $attributes
     *
     * @param array $cookies
     *
     * @param array $files
     *
     * @param array $server
     *
     * @param string|null $content
    */
    public function __construct(
        array $queries = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        string $content = null
    )
    {
         parent::__construct($queries, $request, $attributes, $cookies, $files, $server, $content);
         $this->session  =  new Session();
    }






    /**
     * @param string|null $content
     *
     * @return Request
    */
    public function setContent(?string $content): static
    {
         $this->content = $content;

         return $this;
    }



    /**
     * @return string|null
    */
    public function getContent(): ?string
    {
        return $this->content;
    }




    /**
     * @param SessionInterface $session
     *
     * @return $this
    */
    public function setSession(SessionInterface $session): static
    {
         $this->session = $session;

         return $this;
    }



    /**
     * @return bool
    */
    public function hasPreviousSession(): bool
    {

    }




    /**
     * @return SessionInterface
    */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }



    /**
     * @return string
    */
    public function baseUrl(): string
    {
        return $this->server->getBaseUrl();
    }




    /**
     * @return string
    */
    public function getRequestURI(): string
    {
        return $this->server->getRequestUri();
    }


    /**
     * @param string $method
     *
     * @param string $uri
     *
     * @param array $context
     *
     * @return void
    */
    public static function create(string $method, string $uri, array $context = [])
    {

    }





    /**
     * @param array $queries
     *
     * @param array $request
     *
     * @param array $attributes
     *
     * @param array $cookies
     *
     * @param array $files
     *
     * @param array $server
     *
     * @param string|null $content
     *
     * @return Request
    */
    public static function createFromFactory(
        array $queries = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        string $content = null
    ): static
    {
        return new static($queries, $request, $attributes, $cookies, $files, $server, $content);
    }





    /**
     * @return static
    */
    public static function createFromGlobals(): static
    {
         return static::createFromFactory($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER);
    }
}