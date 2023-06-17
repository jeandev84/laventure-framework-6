<?php
namespace Laventure\Component\Http\Storage\Cookie;



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
     * @param string $value
     *
     * @param int $expireAfter
     *
     * @return mixed
    */
    public function set(string $name, string $value, int $expireAfter = 0): mixed;
}