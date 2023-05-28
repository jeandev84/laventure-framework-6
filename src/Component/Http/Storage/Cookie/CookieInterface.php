<?php
namespace Laventure\Component\Http\Storage\Cookie;

use Laventure\Component\Http\Storage\StorageInterface;



/**
 * @CookieInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @link https://www.php.net/manual/ru/function.setcookie.php
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Storage\Cookie
*/
interface CookieInterface
{

     /**
      * Set cookie
      *
      * @param string $name
      *
      * @param $value
      *
      * @return mixed
     */
     public function set(string $name, $value);




     /**
      * Set expires cookie
      *
      * @param int $times
      *
      * @return mixed
     */
     public function expireAfter(int $times);




     /**
      * Set cookie request path
      *
      * @param string $path
      *
      * @return mixed
     */
     public function path(string $path);




     /**
      * Set cookie domain
      *
      * @param string $domain
      *
      * @return mixed
     */
     public function domain(string $domain);




     /**
      * @param bool $secure
      *
      * @return mixed
     */
     public function secure(bool $secure);




     /**
      * @param bool $httpOnly
      *
      * @return mixed
     */
     public function httpOnly(bool $httpOnly);
}