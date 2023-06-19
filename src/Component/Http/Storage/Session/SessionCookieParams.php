<?php
namespace Laventure\Component\Http\Storage\Session;

use Laventure\Component\Http\Storage\Cookie\CookieParams;


/**
 * @SessionCookieParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @link https://www.php.net/manual/ru/function.setcookie.php
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Storage\Cookie
 */
class SessionCookieParams extends CookieParams
{
    /**
     * @var int|null
    */
    protected ?int $lifetime = 0;


    /**
     * @param int $lifetime
     *
     * @return $this
    */
    public function lifetime(int $lifetime): static
    {
         $this->lifetime = $lifetime;

         return $this;
    }




    /**
     * @return int|null
    */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }
}