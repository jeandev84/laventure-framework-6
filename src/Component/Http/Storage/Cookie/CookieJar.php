<?php
namespace Laventure\Component\Http\Storage\Cookie;


/**
 * @CookieJar
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @link https://www.php.net/manual/ru/function.setcookie.php
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Storage\Cookie
*/
class CookieJar extends Cookie implements CookieJarInterface
{

    /**
     * @inheritDoc
    */
    public function exists(string $name)
    {
         return isset($_COOKIE[$name]);
    }



    /**
     * @inheritDoc
    */
    public function get(string $name): string
    {
        return $_COOKIE[$name] ?? '';
    }




    public function all()
    {
        return $_COOKIE;
    }



    /**
     * @inheritDoc
    */
    public function forever(string $name, string $value)
    {
         $this->set($name, $value, 2628000);
    }
}