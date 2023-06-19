<?php
namespace Laventure\Component\Http\Storage\Session;


use Laventure\Component\Http\Storage\Cookie\CookieJar;


/**
 * @inheritdoc
*/
class Session extends \SessionHandler implements SessionInterface, FlashInterface
{


    /**
     * @var string
    */
    protected $flashKey;



    /**
     * @var CookieJar
    */
    protected $cookieJar;




    /**
     * @param string $flashKey
    */
    public function __construct(string $flashKey = 'session.flash')
    {
         $this->start();
         $this->cookieJar   = new CookieJar();
         $this->flashKey    = $flashKey;
    }




    /**
     * @inheritDoc
    */
    public function status(): int
    {
         return session_status();
    }





    /**
     * @inheritDoc
     */
    public function started(): bool
    {
        return ! empty($this->id());
    }






    /**
     * @inheritDoc
    */
    public function active(): bool
    {
        return $this->hasStatus(PHP_SESSION_ACTIVE);
    }





    /**
     * @inheritDoc
    */
    public function disabled(): bool
    {
        return $this->hasStatus(PHP_SESSION_DISABLED);
    }





    /**
     * @inheritDoc
    */
    public function start(array $options = []): bool
    {
        if ($this->started()) {
            return true;
        }

        return session_start($options);
    }




    /**
     * @inheritdoc
    */
    public function set(string $name, $value): static
    {
        $_SESSION[$name] = $value;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function id(): false|string
    {
        return session_id();
    }




    /**
     * @inheritDoc
     */
    public function name(): string
    {
        return session_name();
    }




    /**
     * @inheritDoc
    */
    public function decode(string $data): bool
    {
         return session_decode($data);
    }




    /**
     * @inheritDoc
    */
    public function encode(): false|string
    {
        return session_encode();
    }




    /**
     * @return bool
    */
    public function put(): bool
    {
        return session_write_close();
    }





    /**
     * @inheritDoc
    */
    public function regenerateId(bool $deleteOldSession = false): bool
    {
        return session_regenerate_id($deleteOldSession);
    }





    /**
     * @inheritDoc
    */
    public function setCookieParams(SessionCookieParams $cookie): static
    {
         session_set_cookie_params(
             $cookie->getLifetime(),
             $cookie->getPath(),
             $cookie->getDomain(),
             $cookie->getSecure(),
             $cookie->getHttpOnly()
         );

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function getCookieParams(): array
    {
         return session_get_cookie_params();
    }






    /**
     * @inheritDoc
    */
    public function setModuleName(?string $module = null): false|string
    {
        return session_module_name($module);
    }





    /**
     * @inheritDoc
     */
    public function registerShutdown(): void
    {
        session_register_shutdown();
    }





    /**
     * @inheritDoc
     */
    public function unset(): bool
    {
        return session_unset();
    }



    /**
     * @inheritDoc
    */
    public function reset(): bool
    {
        return session_reset();
    }





    /**
     * @inheritDoc
    */
    public function abort(): bool
    {
        return session_abort();
    }




    /**
     * @inheritDoc
    */
    public function savePath(?string $path = null): string|false
    {
        return session_save_path($path);
    }





    /**
     * @inheritDoc
    */
    public function saveHandler(object $sessionHandler, bool $registerShutdown = true): bool
    {
        return session_set_save_handler($sessionHandler, $registerShutdown);
    }



    /**
     * @inheritDoc
    */
    public function commit(): bool
    {
        return session_commit();
    }




    /**
     * @inheritDoc
    */
    public function cacheExpire(?int $value = null): false|int
    {
        return session_cache_expire($value);
    }




    /**
     * @inheritDoc
     */
    public function cacheLimiter(?string $value = null): string|false
    {
        return session_cache_limiter();
    }




    /**
     * @inheritDoc
    */
    public function add($key, $value)
    {
        $_SESSION[$key] = $value;
    }



    /**
     * @inheritDoc
    */
    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }



    /**
     * @inheritDoc
    */
    public function has($key): bool
    {
        return isset($_SESSION[$key]);
    }



    /**
     * @inheritDoc
    */
    public function remove($key): bool
    {
         if ($this->has($key)) {
             unset($_SESSION[$key]);
             return empty($_SESSION[$key]);
         }

         return false;
    }



    /**
     * @return bool
    */
    public function isEmpty()
    {
        return empty($_SESSION);
    }





    /**
     * @inheritDoc
    */
    public function clear(): bool
    {
        if (! $id = $this->id()) {
             return false;
        }

        $this->cookieJar->set($this->name(), $id, -60*60*24);

        session_unset();
        session_destroy();

        return $this->isEmpty();
    }






    /**
     * @inheritDoc
    */
    public function all()
    {
         return $_SESSION;
    }




    /**
     * @inheritDoc
    */
    public function save($path)
    {
        return $this->savePath($path);
    }




    /**
     * @param int $status
     *
     * @return bool
    */
    protected function hasStatus(int $status): bool
    {
        return $this->status() === $status;
    }



    /**
     * @inheritDoc
    */
    public function merge(array $params)
    {
        foreach ($params as $name => $value) {
             $this->add($name, $value);
        }
    }



    /**
     * @inheritDoc
    */
    public function setFlashSessionKey(string $flashKey): static
    {
        $this->flashKey = $flashKey;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addFlash(string $key, $value): static
    {
         $_SESSION[$this->flashKey][$key][] = $value;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function getFlash(string $key)
    {
        // TODO: Implement getFlash() method.
    }




    /**
     * @inheritDoc
     */
    public function hasFlash(string $key)
    {
        // TODO: Implement hasFlash() method.
    }

    /**
     * @inheritDoc
     */
    public function getFlashes()
    {
        // TODO: Implement getFlashes() method.
    }



    /**
     * @inheritDoc
    */
    public function clearFlashes()
    {
        if ($this->has($this->flashKey)) {
            $this->destroy($this->flashKey);
        }
    }



    /**
     * Session destructor
    */
    public function __destruct()
    {
        $this->clearFlashes();
    }
}