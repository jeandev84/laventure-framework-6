<?php
namespace Laventure\Component\Http\Message\Request;

use Laventure\Component\Message\Http\Storage\Session\SessionInterface;


/**
 * @cUrlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\cUrlRequest
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
        return $this->content ?? $this->body;
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
     * @param string $url
     *
     * @param string $method
     *
     * @param array $queries
     *
     * @param array $request
     *
     * @param array $cookies
     *
     * @param array $files
     *
     * @param array $server
     *
     * @param string|null $content
     *
     * @return $this
    */
    public static function create(
        string $url,
        string $method,
        array $queries = [],
        array $request = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        string $content = null
    ): static
    {

        $uri     = new Uri($url);
        $request = static::createFromFactory($queries, $request, [], $cookies, $files, $server);
        $uri->withQuery(http_build_query($queries, '', '&'));
        $request->withUri($uri);
        $request->withMethod(strtoupper($method));
        $request->setContent($content);
        return $request;
    }
}