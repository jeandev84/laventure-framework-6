<?php
namespace Laventure\Component\Http\Storage\Cookie;


/**
 * @inheritdoc
*/
class Cookie implements CookieInterface
{


    /**
     * Cookie path
     *
     * @var string
    */
    protected $path;




    /**
     * Cookie domain
     *
     * @var string
    */
    protected $domain;





    /**
     * @var bool
    */
    protected $secure;




    /**
     * @var bool
    */
    protected $httpOnly;





    /**
     * The name of the cookie.
     *
     * @var string
    */
    protected $name;




    /**
     * The value of the cookie. This value is stored on the clients computer; do not store sensitive information
     *
     * @var mixed
    */
    protected $value;



    /**
     * Cookie expiration lifetime
     *
     * @var int
    */
    protected $expiresAfter;


    /**
     * @param string $path
     *
     * @param string $domain
     *
     * @param bool $secure
     *
     * @param bool $httpOnly
    */
    public function __construct(string $path, string $domain, bool $secure = false, bool $httpOnly = false)
    {
         $this->path($path);
         $this->domain($domain);
         $this->secure($secure);
         $this->httpOnly($httpOnly);
    }



    /**
     * @inheritdoc
    */
    public function set(string $name, $value): static
    {
         $this->name  = $name;
         $this->value = $value;

         return $this;
    }



    /**
     * @inheritDoc
    */
    public function expireAfter(int $times): static
    {
        $this->expiresAfter = time() + $times;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function domain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function secure(bool $secure): static
    {
        $this->secure = $secure;

        return $this;
    }





    /**
     * @inheritDoc
     */
    public function httpOnly(bool $httpOnly)
    {
        $this->httpOnly = $httpOnly;

        return $this;
    }



    public function __destruct()
    {
        setcookie($this->name, $this->value, $this->expiresAfter, $this->path, $this->domain, $this->secure, $this->httpOnly);
    }
}