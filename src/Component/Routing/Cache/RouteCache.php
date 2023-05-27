<?php
namespace Laventure\Component\Routing\Cache;


use Laventure\Component\Routing\Route\RouteInterface;


/**
 * @RouteCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Cache
*/
class RouteCache implements RouteCacheInterface
{

     /**
      * @var string
     */
     protected $cacheDir;



     /**
      * Route constructor
      *
      * @param string|null $cacheDir
     */
     public function __construct(string $cacheDir = null)
     {
          if ($cacheDir) {
              $this->cacheRouteDir($cacheDir);
          }
     }




     /**
      * @inheritDoc
     */
     public function cacheRouteDir(string $cacheDir): static
     {
          $this->cacheDir = rtrim($cacheDir, DIRECTORY_SEPARATOR);

          return $this;
     }




     /**
      * @inheritdoc
     */
     public function cacheRoute(string $key, RouteInterface $route): static
     {
          if (! $route->isCallable()) {
              $this->cache($key, serialize($route));
          }

          return $this;
     }




     /**
      * @inheritdoc
     */
     public function getRoute(string $key): ?RouteInterface
     {
         $content = file_get_contents($this->path($key));

         if (! $this->hasRoute($key) || $content) {
              return null;
         }

         return unserialize($content);
     }




     /**
      * @param string $key
      *
      * @return bool
     */
     public function hasRoute(string $key): bool
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
     private function cache(string $key, $content): bool|int
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