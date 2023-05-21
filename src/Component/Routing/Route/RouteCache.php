<?php
namespace Laventure\Component\Routing\Route;


/**
 * @RouteCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Cache
*/
class RouteCache
{

     /**
      * @var string
     */
     protected $cacheDir;



     /**
      * @param string $cacheDir
      *
      * @return void
     */
     public function cacheDir(string $cacheDir): void
     {
          $this->cacheDir = rtrim($cacheDir, DIRECTORY_SEPARATOR);
     }


    /**
     * @param string $key
     *
     * @param Route $route
     *
     * @return $this
     */
     public function set(string $key, Route $route): static
     {
          if (! $route->isCallable()) {
              $this->cache($key, serialize($route));
          }

          return $this;
     }




     /**
      * @param string $key
      *
      * @return Route|false
     */
     public function get(string $key): Route|bool
     {
         if (! $this->has($key)) {
              return false;
         }

         $content = file_get_contents($this->path($key));

         if (! $content) {
             return false;
         }

         return unserialize($content);
     }




     /**
      * @param string $key
      *
      * @return bool
     */
     public function has(string $key): bool
     {
         return file_exists($this->path($key));
     }





     /**
      * @param string $key
      *
      * @param $content
      *
      * @return bool|int
     */
     public function cache(string $key, $content): bool|int
     {
          $filename = $this->path($key);
          $dirname = dirname($filename);

          if (! is_dir($dirname)) {
              mkdir($dirname, 0777, true);
          }

          touch($filename);

          return file_put_contents($filename, "$content".PHP_EOL, FILE_APPEND);
     }




     /**
      * @param string $key
      * @return string
     */
     public function path(string $key): string
     {
         return join(DIRECTORY_SEPARATOR, [$this->cacheDir, "routes", md5($key). '.cache']);
     }
}