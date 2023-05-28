<?php
namespace Laventure\Component\Http\Request;

use Laventure\Component\Http\Storage\Session\SessionInterface;


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
         parent::__construct($queries, $request, $attributes, $cookies, $files, $server);
         $this->content  = $content;
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
        if (! $this->content) {
            return http_get_request_body();
        }

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
    public function getRequestUri(): string
    {
        return $this->server->getRequestUri();
    }




    /**
     * @return string
    */
    public function getPath(): string
    {
        return $this->server->getPathInfo();
    }





    /**
     * @param string $method
     *
     * @param string $url
     *
     * @param array $context
     *
     * @return static
    */
    public static function create(string $method, string $url, array $context = []): static
    {
        /*
        $request   = new static();
        $parameter = new ParameterBag($context);
        $server    = new ServerBag($parameter->get('server'));
        $query     = new InputBag($parameter->get('queries'));
        $cookie    = new CookieBag($parameter->get('cookies'));

        $request->server = $server;
        $request->withUri(new Uri($url));
        $request->withMethod($method);
        $request->withRequestTarget($url);
        $request->withQueryParams($query->all());
        $request->withCookieParams($cookie->all());

        return $request;
        */
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




    public static function createFromStream() {}
}