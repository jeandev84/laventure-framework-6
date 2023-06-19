<?php
namespace Laventure\Component\Http\Storage\Cookie;


/**
 * @inheritdoc
*/
class Cookie implements CookieInterface
{

    /**
     * @inheritdoc
    */
    public function setCookie(CookieParams $cookie): static
    {
         setcookie(
             $cookie->getName(),
             $cookie->getValue(),
             $cookie->getExpireAfter(),
             $cookie->getPath(),
             $cookie->getDomain(),
             $cookie->getSecure(),
             $cookie->getHttpOnly()
         );


         return $this;
    }





    /**
     * @param string $name
     *
     * @param string $value
     *
     * @param int $expireAfter
     *
     * @return $this
    */
    public function set(string $name, string $value, int $expireAfter = 0): static
    {
        return $this->setCookie(new CookieParams($name, $value, $expireAfter));
    }
}