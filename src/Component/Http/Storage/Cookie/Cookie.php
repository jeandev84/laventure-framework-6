<?php
namespace Laventure\Component\Http\Storage\Cookie;


/**
 * @Cookie
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Storage\Cookie
*/
class Cookie implements CookieInterface
{


     /**
      * @var string
     */
     protected string $name;




     /**
      * @var mixed
     */
     protected mixed $value;




     /**
      * @var string
     */
     protected string $domain;



     /**
      * @var bool
     */
     protected bool $httpOnly;



     /**
       * @param string $name
       *
       * @param $value
       *
      * @param int $times
     */
     public function __construct(string $name, $value, int $times)
     {
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




     public function __destruct()
     {
         setcookie($this->name, $this->value, $this->expiresAfter);
     }
}