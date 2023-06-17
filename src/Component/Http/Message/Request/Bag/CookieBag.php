<?php
namespace Laventure\Component\Http\Message\Request\Bag;

use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Storage\Cookie\CookieJar;


/**
 * @CookieBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\cUrlRequest\Bag
*/
class CookieBag extends ParameterBag
{

     /**
      * @var CookieJar
     */
     protected $cookieJar;


     /**
      * @param array $params
     */
     public function __construct(array $params = [])
     {
          parent::__construct($params);
          $this->cookieJar = new CookieJar();
     }







    /**
     * @param string $path
     *
     * @return $this
    */
    public function path(string $path): static
    {
        $this->cookieJar->path($path);

        return $this;
    }





    /**
     * @param string $domain
     *
     * @return $this
    */
    public function domain(string $domain): static
    {
        $this->cookieJar->domain($domain);

        return $this;
    }





    /**
     * @param bool $secure
     *
     * @return $this
     */
    public function secure(bool $secure): static
    {
        $this->cookieJar->secure($secure);

        return $this;
    }




    /**
     * @param bool $httpOnly
     *
     * @return $this
    */
    public function httpOnly(bool $httpOnly)
    {
        $this->cookieJar->httpOnly($httpOnly);

        return $this;
    }




     /**
      * @param string $name
      *
      * @param $value
      *
      * @param int $expires
      *
      * @return static
     */
     public function set($name, $value, int $expires = 3600): static
     {
         $this->cookieJar->set($name, $value, $expires);

         return parent::set($name, $value);
     }




     /**
      * @inheritdoc
     */
     public function clear(): void
     {
         foreach ($this->keys() as $name) {
             $this->remove($name);
         }
     }




     /**
      * @inheritdoc
     */
     public function remove($name): mixed
     {
         $this->cookieJar->clear($name);

         parent::remove($name);

         return $this;
     }
}