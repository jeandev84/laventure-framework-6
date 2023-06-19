<?php
namespace Laventure\Component\Http\Storage\Cookie;



/**
 * @CookieParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @link https://www.php.net/manual/ru/function.setcookie.php
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Storage\Cookie
*/
class CookieParams
{


    /**
     * @var string|null
    */
    protected ?string $name = null;



    /**
     * @var string|null
    */
    protected ?string $value = null;



    /**
     * @var int|null
    */
    protected ?int $expireAfter = 0;



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
    protected ?bool $secure = false;




    /**
     * @var bool
    */
    protected ?bool $httpOnly = false;




    /**
     * @param string $name
     *
     * @param string $value
     *
     * @param int $expireAfter
    */
    public function __construct(string $name, string $value, int $expireAfter = 0)
    {
        $this->name($name);
        $this->value($value);
        $this->expireAfter($expireAfter);
    }




    /**
     * @param string $name
     *
     * @return $this
    */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @param string $value
     *
     * @return $this
    */
    public function value(string $value): static
    {
        $this->value = $value;

        return $this;
    }




    /**
     * @param int $expireAfter
     *
     * @return $this
    */
    public function expireAfter(int $expireAfter): static
    {
        $this->expireAfter = $expireAfter;

        return $this;
    }



    /**
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->path = $path;

        return $this;
    }




    /**
     * @param string $domain
     *
     * @return $this
    */
    public function domain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }




    /**
     * @param bool $secure
     *
     * @return $this
    */
    public function secure(bool $secure): static
    {
        $this->secure = $secure;

        return $this;
    }




    /**
     * @param bool $httpOnly
     *
     * @return $this
    */
    public function httpOnly(bool $httpOnly): static
    {
        $this->httpOnly = $httpOnly;

        return $this;
    }




    /**
     * @return string|null
    */
    public function getName(): ?string
    {
        return $this->name;
    }



    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }


    /**
     * @return int|null
    */
    public function getExpireAfter(): ?int
    {
        return $this->expireAfter;
    }


    /**
     * @return string
    */
    public function getPath(): string
    {
        return $this->path;
    }


    /**
     * @return string|null
    */
    public function getDomain(): ?string
    {
        return $this->domain;
    }





    /**
     * @return bool|null
     */
    public function getHttpOnly(): ?bool
    {
        return $this->httpOnly;
    }


    /**
     * @return bool|null
     */
    public function getSecure(): ?bool
    {
        return $this->secure;
    }
}