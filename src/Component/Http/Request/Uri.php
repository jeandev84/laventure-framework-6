<?php
namespace Laventure\Component\Http\Request;

use Laventure\Component\Http\Request\Contract\UriInterface;


/**
 * @Uri
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\Uri
*/
class Uri implements UriInterface
{

    /**
     * Get scheme
     *
     * @var string
     */
    protected $scheme;




    /**
     * Get host
     *
     * @var string
     */
    protected $host;





    /**
     * Get username
     *
     * @var string
     */
    protected $username;




    /**
     * Get password
     *
     * @var string
     */
    protected $password;







    /**
     * Get port
     *
     * @var string
     */
    protected $port;





    /**
     * Get path
     *
     * @var string
    */
    protected $path;





    /**
     * Query string
     *
     * @var string
     */
    protected $queryString;





    /**
     * Fragment request
     *
     * @var string
    */
    protected $fragment;



    /**
     * @var string
    */
    protected $url;


    /**
     * @param string $url
    */
    public function __construct(string $url)
    {
        $this->parseURL($url);
    }





    /**
     * @inheritDoc
    */
    public function getScheme(): ?string
    {
        return $this->scheme;
    }



    /**
     * @inheritDoc
     */
    public function getAuthority(): ?string
    {
        return sprintf("%s@%s", $this->getUserInfo(), $this->getHost());
    }




    /**
     * @inheritDoc
    */
    public function getUserInfo(): ?string
    {
        return "$this->username:$this->password";
    }





    /**
     * @inheritDoc
     */
    public function getHost(): ?string
    {
        return $this->host;
    }




    /**
     * @inheritDoc
    */
    public function getPort(): ?string
    {
        return $this->port;
    }




    /**
     * @inheritDoc
    */
    public function getPath(): ?string
    {
        return $this->path;
    }



    /**
     * @inheritDoc
    */
    public function getQuery(): ?string
    {
        return $this->queryString;
    }



    /**
     * @inheritDoc
    */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }




    /**
     * @inheritDoc
     */
    public function withScheme($scheme): static
    {
        $this->scheme = $scheme;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function withUserInfo($user, $password = null): static
    {
        $this->username  = $user;
        $this->password  = $password;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withHost($host): static
    {
        $this->host = $host;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withPort($port): static
    {
        $this->port = (int)$port;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withPath($path): static
    {
        $this->path = $path;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function withQuery($query): static
    {
        $this->queryString = $query;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function withFragment($fragment): static
    {
        $this->fragment = $fragment;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return sprintf('%s://%s%s%s%s',
            $this->getScheme(),
            $this->getAuthority(),
            $this->getPath(),
            $this->getQuery(),
            $this->getFragment()
        );
    }




    /**
     * @return array
    */
    public function toArray(): array
    {
        return parse_url($this->url);
    }




    /**
     * @param string $url
     *
     * @param int $component
     *
     * @return string|null
    */
    public function parse(string $url, int $component): ?string
    {
        return parse_url($url, $component);
    }



    /**
     * @param string $url
     *
     * @return void
    */
    private function parseURL(string $url): void
    {
        $this->withScheme($this->parse($url, PHP_URL_SCHEME));
        $this->withUserInfo($this->parse($url, PHP_URL_USER), $this->parse($url, PHP_URL_PASS));
        $this->withHost($this->parse($url, PHP_URL_HOST));
        $this->withPort($this->parse($url, PHP_URL_PORT));
        $this->withPath($this->parse($url, PHP_URL_PATH));
        $this->withQuery($this->parse($url, PHP_URL_QUERY));
        $this->withFragment($this->parse($url, PHP_URL_FRAGMENT));
    }
}