<?php
namespace Laventure\Component\Http\Request\Bag;

use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Storage\Cookie\Cookie;


/**
 * @CookieBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\Bag
*/
class CookieBag extends ParameterBag
{

     /**
      * @param array $params
     */
     public function __construct(array $params = [])
     {
         parent::__construct($params);
     }



    /**
     * Cookie path
     *
     * @var string
     */
    protected $path = '/';




    /**
     * Cookie domain
     *
     * @var string
    */
    protected $domain = '';






    /**
     * @var bool
    */
    protected $secure = false;




    /**
     * @var bool
    */
    protected $httpOnly = false;




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
    public function httpOnly(bool $httpOnly)
    {
        $this->httpOnly = $httpOnly;

        return $this;
    }




     /**
      * @param string $name
      * @param $value
      * @param int $expires
      * @return Cookie
     */
     public function set(string $name, $value, int $expires = 3600): Cookie
     {
         $cookie = new Cookie($this->path, $this->domain, $this->secure, $this->httpOnly);
         return $cookie->set($name, $value)->expireAfter($expires);
     }





     /**
      * @param string $name
      *
      * @return void
     */
     public function remove(string $name): void
     {
         $this->set($name, '', -3600);
         parent::remove($name);
     }
}