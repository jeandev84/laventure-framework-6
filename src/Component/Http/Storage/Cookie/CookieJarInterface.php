<?php
namespace Laventure\Component\Message\Http\Storage\Cookie;


/**
 * @CookieJarInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @link https://www.php.net/manual/ru/function.setcookie.php
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Message\Http\Storage\Cookie
*/
interface CookieJarInterface extends CookieInterface
{

     /**
      * @param string $name
      * @return mixed
     */
     public function exists(string $name);




     /**
      * @param string $name
      *
      * @return mixed
     */
     public function get(string $name);




     /**
      * @param string $name
      * @param string $value
      * @return mixed
     */
     public function forever(string $name, string $value);
}