<?php
namespace Laventure\Component\Http\Request;

use Laventure\Component\Http\Request\Contract\UriInterface;


/**
 * @Uri
 *
 * @link https://www.php.net/manual/en/function.parse-url.php
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
     * @param $url
    */
    public function __construct($url = null)
    {
          if ($url) { $this->parseUrl($url); }
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
        if (! $this->scheme) { return ''; }

        return sprintf('%s://%s%s%s%s%s',
            $this->getScheme(),
            $this->getAuthority(),
            $this->getHost(),
            $this->getPath(),
            $this->getQuery(),
            $this->getFragment()
        );
    }





    /**
     * @param string $url
     *
     * @return string|null
    */
    private function scheme(string $url): ?string
    {
        return (string)parse_url($url,PHP_URL_SCHEME);
    }





    /**
     * @param string $url
     * @return string|null
    */
    private function user(string $url): ?string
    {
        return (string)parse_url($url, PHP_URL_USER);
    }




    /**
     * @param string $url
     * @return string|null
    */
    private function password(string $url): ?string
    {
        return (string)parse_url($url, PHP_URL_PASS);
    }




    /**
     * @param string $url
     *
     * @return string|null
    */
    private function host(string $url): ?string
    {
        return (string)parse_url($url, PHP_URL_HOST);
    }




    /**
     * @param string $url
     * @return string|null
    */
    private function port(string $url): ?string
    {
        return (string)parse_url($url, PHP_URL_PORT);
    }




    /**
     * @param string $url
     * @return string|null
    */
    private function path(string $url): ?string
    {
        return (string)parse_url($url, PHP_URL_PATH);
    }





    /**
     * @param string $url
     * @return string|null
    */
    private function query(string $url): ?string
    {
        return (string)parse_url($url, PHP_URL_QUERY);
    }




    /**
     * @param string $url
     * @return string|null
    */
    private function fragment(string $url): ?string
    {
        return (string)parse_url($url, PHP_URL_FRAGMENT);
    }




    /**
     * @param string $url
     *
     * @return void
    */
    private function parseUrl(string $url): void
    {
        $this->withScheme($this->scheme($url));
        $this->withUserInfo($this->user($url), $this->password($url));
        $this->withHost($this->host($url));
        $this->withPort($this->port($url));
        $this->withPath($this->path($url));
        $this->withQuery($this->query($url));
        $this->withFragment($this->fragment($url));
    }
}