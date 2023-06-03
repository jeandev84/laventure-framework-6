<?php
namespace Laventure\Component\Http\Message\Request\Parser;

use Laventure\Component\Http\Bag\ParameterBag;

class UrlParser implements UrlParserInterface
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
    protected $query;





    /**
     * Fragment request
     *
     * @var string
    */
    protected $fragment;




    /**
     * @param string $url
    */
    public function __construct(string $url)
    {
        $this->parseUrl($url);
    }




    /**
     * @inheritDoc
    */
    public function parseUrl(string $url)
    {
        $this->scheme   = $this->scheme($url);
        $this->username = $this->user($url);
        $this->password = $this->password($url);
        $this->host     = $this->host($url);
        $this->port     = $this->port($url);
        $this->query    = $this->query($url);
        $this->fragment = $this->fragment($url);
    }




    /**
     * @param string $url
     *
     * @return ParameterBag
    */
    public function parse(string $url): ParameterBag
    {
         return new ParameterBag(parse_url($url));
    }





    /**
     * @return string|null
    */
    public function getScheme(): ?string
    {
        return $this->scheme;
    }




    /**
     * @return string|null
    */
    public function getHost(): ?string
    {
        return $this->host;
    }



    /**
     * @return string|null
    */
    public function getUsername(): ?string
    {
        return $this->username;
    }




    /**
     * @return string|null
    */
    public function getPassword(): ?string
    {
        return $this->password;
    }




    /**
     * @return string|null
    */
    public function getPort(): ?string
    {
        return $this->port;
    }




    /**
     * @return string|null
    */
    public function getPath(): ?string
    {
        return $this->path;
    }




    /**
     * @return string|null
    */
    public function getQueryString(): ?string
    {
        return $this->query;
    }




    /**
     * @return string|null
    */
    public function getFragment(): ?string
    {
        return $this->fragment;
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
}