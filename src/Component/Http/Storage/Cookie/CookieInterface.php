<?php
namespace Laventure\Component\Message\Http\Storage\Cookie;



use Laventure\Component\Message\Http\Storage\StorageInterface;

/**
 * @CookieInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @link https://www.php.net/manual/ru/function.setcookie.php
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Message\Http\Storage\Cookie
*/
interface CookieInterface
{


     /**
      * Set cookie request path
      *
      * @param string $path
      *
      * @return $this
     */
     public function path(string $path): static;




     /**
      * Set cookie domain
      *
      * @param string $domain
      *
      * @return $this
     */
     public function domain(string $domain): static;





     /**
      * @param bool $secure
      *
      * @return $this
     */
     public function secure(bool $secure): static;




     /**
      * @param bool $httpOnly
      *
      * @return $this
     */
     public function httpOnly(bool $httpOnly): static;



     /**
      * Set cookie
      *
      * @param string $name
      *
      * @param $value
      *
      * @param int $expireAfter
      *
      * @return void
     */
     public function set(string $name, $value, int $expireAfter = 3600): void;
}