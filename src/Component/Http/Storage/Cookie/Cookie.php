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
     * @var string|null
    */
    protected ?string $domain;





    /**
     * @var bool
    */
    protected bool $secure;




    /**
     * @var bool
    */
    protected bool $httpOnly;




    /**
     * @param string $path
     *
     * @param string $domain
     *
     * @param bool $secure
     *
     * @param bool $httpOnly
    */
    public function __construct(string $path = '/', string $domain = '', bool $secure = false, bool $httpOnly = false)
    {
         $this->path($path);
         $this->domain($domain);
         $this->secure($secure);
         $this->httpOnly($httpOnly);
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
    public function httpOnly(bool $httpOnly): static
    {
        $this->httpOnly = $httpOnly;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function set(string $name, $value, int $expireAfter = 3600): static
    {
         setcookie($name, $value, time() + $expireAfter, $this->path, $this->domain, $this->secure, $this->httpOnly);

         return $this;
    }




    /**
     * @return string|null
    */
    public function getDomain(): ?string
    {
        return $this->domain;
    }




    /**
     * @return string
    */
    public function getPath(): string
    {
        return $this->path;
    }



    /**
     * @inheritDoc
    */
    public function clear(string $name)
    {
        $this->set($name, '', time() - 3600);
    }
}