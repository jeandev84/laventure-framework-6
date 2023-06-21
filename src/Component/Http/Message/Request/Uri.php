<?php
namespace Laventure\Component\Http\Message\Request;

use Laventure\Component\Http\Message\Request\Contract\UriInterface;
use Laventure\Component\Http\Message\Request\Parser\UrlParser;


/**
 * @Uri
 *
 * @link https://www.php.net/manual/en/function.parse-url.php
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Request
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
     * Builder string
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
     * @param $url
    */
    public function __construct($url)
    {
        $this->parseUrl($url);
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
        if ($this->username || $this->password) {
            return "$this->username@$this->password";
        }

        return '';
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
        if ($this->port) {
             $this->host .= ':'. $this->port;
        }

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
     * @return string
    */
    public function getQueryString(): string
    {
        if (! $this->queryString) {
            return '';
        }

        return '?'. $this->queryString;
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
        if (! $this->scheme) {
             throw new \Exception("URI scheme is empty.");
        }

        return sprintf('%s://%s%s%s%s%s',
            $this->getScheme(),
            $this->getAuthority(),
            $this->getHost(),
            $this->getPath(),
            $this->getQueryString(),
            $this->getFragment()
        );
    }



    /**
     * @param string $url
     *
     * @return void
    */
    private function parseUrl(string $url): void
    {
        $parser = new UrlParser($url);
        $this->withScheme($parser->getScheme());
        $this->withUserInfo($parser->getUsername(), $parser->getPassword());
        $this->withHost($parser->getHost());
        $this->withPort($parser->getPort());
        $this->withPath($parser->getPath());
        $this->withQuery($parser->getQueryString());
        $this->withFragment($parser->getFragment());
    }
}