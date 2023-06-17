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
    protected $path = '';




    /**
     * Cookie domain
     *
     * @var string|null
    */
    protected ?string $domain = '';





    /**
     * @var bool
    */
    protected bool $secure;




    /**
     * @var bool
    */
    protected bool $httpOnly;




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
    public function set(string $name, $value, int $expireAfter = 0): static
    {
         setcookie($name, $value, $expireAfter, $this->path, $this->domain, $this->secure, $this->httpOnly);

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
}