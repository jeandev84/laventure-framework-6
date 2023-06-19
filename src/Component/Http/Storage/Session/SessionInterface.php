<?php
namespace Laventure\Component\Http\Storage\Session;

use Laventure\Component\Http\Storage\StorageInterface;
use SessionHandlerInterface;


/**
 * @inheritdoc
 * @link https://www.php.net/manual/en/ref.session.php
*/
interface SessionInterface extends StorageInterface
{

      /**
       * Start new or resume existing session
       *
       * @link https://www.php.net/manual/en/function.session-start.php
       *
       * @return int
      */
      public function status();




      /**
       * Start session
       *
       * @param array $options
       *
       * @return bool
      */
      public function start(array $options = []);





      /**
       * Determine has a session already started
       *
       * @return bool
      */
      public function started(): bool;




      /**
       * @param string $name
       *
       * @param $value
       *
       * @return mixed
      */
      public function set(string $name, $value);





      /**
       * Determine has a session active
       *
       * @return bool
      */
      public function active(): bool;





      /**
       * Determine if session disabled
       *
       * @return bool
      */
      public function disabled();




     /**
      * Returns id of session
      *
      * @return mixed
     */
     public function id();




     /**
      * Returns name of session
      *
      * @return mixed
     */
     public function name();




     /**
      * Decode the session
      *
      * @param string $data
      *
      * @link https://www.php.net/manual/en/function.session-decode.php
      *
      * @return mixed
     */
     public function decode(string $data);





     /**
      * Encode session
      *
      * @link https://www.php.net/manual/en/function.session-encode.php
      *
      * @return mixed
     */
     public function encode();





    /**
     * Regenerate a new session id from given name
     *
     * @link https://www.php.net/manual/en/function.session-regenerate-id.php
     *
     * @param bool $deleteOldSession
     *
     * @return mixed
     */
     public function regenerateId(bool $deleteOldSession = false);




     /**
      * Set cookie params
      *
      * @link https://www.php.net/manual/en/function.session-set-cookie-params.php
      *
      * @param SessionCookieParams $cookie
      *
      * @return mixed
     */
     public function setCookieParams(SessionCookieParams $cookie);





     /**
      * Return data params
      *
      * @link https://www.php.net/manual/en/function.session-get-cookie-params.php
      *
      * @return array
     */
     public function getCookieParams();




     /**
      * Return session module name
      *
      * @link https://www.php.net/manual/en/function.session-module-name.php
      *
      * @return mixed
     */
     public function setModuleName(?string $module = null);





     /**
      * Session shutdown function
      *
      * @link https://www.php.net/manual/en/function.session-register-shutdown.php
      *
      * @return mixed
     */
     public function registerShutdown();





     /**
      * Unset session for given param
      *
      * @link https://www.php.net/manual/en/function.session-unset.php
      *
      * @return mixed
     */
     public function unset();




     /**
      * Reset session
      *
      * @link https://www.php.net/manual/en/function.session-reset.php
      *
      * @return mixed
     */
     public function reset();




     /**
      * Abort current session
      *
      * @link  https://www.php.net/manual/en/function.session-abort.php
      *
      * @return mixed
     */
     public function abort();




     /**
      * Save the session to the given path
      *
      * @link https://www.php.net/manual/en/function.session-save-path.php
      *
      * @param string|null $path
      *
      * @return mixed
     */
     public function savePath(?string $path = null);




     /**
      * Set session save handler
      *
      * @param SessionHandlerInterface $sessionHandler
      *
      * @param bool $registerShutdown
      *
      * @return mixed
     */
     public function saveHandler(SessionHandlerInterface $sessionHandler, bool $registerShutdown = true);





    /**
     * Commit session, write and close
     *
     * @link https://www.php.net/manual/en/function.session-commit.php
     *
     * @return mixed
    */
    public function commit();




    /**
     * Cache session expires
     *
     * Get and/or set current cache expire
     *
     * @link https://www.php.net/manual/en/function.session-cache-expire.php
     *
     * @param int|null $value
     *
     * @return mixed
    */
    public function cacheExpire(?int $value = null);




    /**
     * Cache session limiter
     *
     * Get and/or set the current cache limiter
     *
     * @link https://www.php.net/manual/en/function.session-cache-limiter.php
     *
     * @param string|null $value
     *
     * @return mixed
    */
    public function cacheLimiter(?string $value = null);
}