<?php
namespace Laventure\Component\Http\Storage\Cookie;



use Laventure\Component\Http\Storage\Session\SessionCookieParams;

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
     * @param CookieParams $cookie
     *
     * @return mixed
    */
    public function setCookie(CookieParams $cookie): mixed;
}