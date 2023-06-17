<?php
namespace Laventure\Component\Http\Storage\Cookie;

use Laventure\Component\Http\Storage\StorageInterface;


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
class CookieJar extends Cookie implements StorageInterface
{


    /**
     * @var array
    */
    protected array $params = [];



    /**
     * @param array $cookies
    */
    public function __construct(array $cookies = [])
    {
         $this->params = $cookies ?: $_COOKIE;
    }





    /**
     * @param string $name
     *
     * @param $value
     *
     * @param int $expireAfter
     *
     * @return $this
    */
    public function set(string $name, $value, int $expireAfter = 3600): static
    {
          parent::set($name, $value, time() + $expireAfter);

          $this->params[$name] = $value;

          return $this;
    }






    /**
     * @inheritdoc
    */
    public function remove($key): bool
    {
        $this->set($key, '', time() - 3600);

        unset($this->params[$key]);

        return ! $this->has($key);
    }
    
    


    /**
     * @inheritDoc
    */
    public function has($key): bool
    {
        return isset($this->params[$key]);
    }





    /**
     * @inheritdoc 
    */
    public function get($key): ?string
    {
        return $this->params[$key] ?? null;
    }





    /**
     * Returns all cookies
     *
     * @return array
    */
    public function all(): array
    {
        return $this->params;
    }





    /**
     * Set cookies forever
    */
    public function forever(string $name, string $value): static
    {
         return $this->set($name, $value, 2628000);
    }





    /**
     * Remove all cookies
    */
    public function clear(): bool
    {
        foreach ($this->getNames() as $name) {
            $this->remove($name);
        }

        return empty($this->params);
    }





    /**
     * @return int[]|string[]
    */
    private function getNames()
    {
        return array_keys($this->params);
    }
}