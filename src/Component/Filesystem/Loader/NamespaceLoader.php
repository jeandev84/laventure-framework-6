<?php
namespace Laventure\Component\Filesystem\Loader;

use Laventure\Component\Filesystem\Loader\Contract\NamespaceLoaderInterface;
use Laventure\Component\Filesystem\Locator\FileLocator;


/**
 * @inheritDoc
*/
class NamespaceLoader extends ClassLoader implements NamespaceLoaderInterface
{
     /**
      * @var array
     */
     protected array $prefixes = [];




     /**
      * @param FileLocator $locator
      * @param array $prefixes
     */
     public function __construct(FileLocator $locator, array $prefixes = [])
     {
           parent::__construct($locator);
           $this->addNamespaces($prefixes);
     }



     /**
      * Add namespaces prefixes
      *
      * @param string $prefix
      *
      * @param string $baseDir
      *
      * @return $this
     */
     public function addNamespace(string $prefix, string $baseDir): static
     {
          $prefix = $this->normalizeNamespace($prefix);

          $this->prefixes[$prefix] = $this->normalizeBaseDirectory($baseDir);

          return $this;
     }




     /**
      * Add namespaces
      *
      * @param array $prefixes
      *
      * @return $this
     */
     public function addNamespaces(array $prefixes): static
     {
         foreach ($prefixes as $prefix => $baseDir) {
              $this->addNamespace($prefix, $baseDir);
         }

         return $this;
     }


     /**
      * @param string $namespace
      *
      * @return bool
     */
     public function hasNamespace(string $namespace): bool
     {
          return array_key_exists($namespace, $this->prefixes);
     }




     /**
      * @param string $class
      * @return mixed
     */
     public function loadClass(string $class): mixed
     {
          $fragments = $this->getClassFragments($class);
          $prefix    = array_shift($fragments);

          if (! $this->hasNamespace($prefix)) {
              return false;
          }

          $class = join(DIRECTORY_SEPARATOR, [$this->prefixes[$prefix], $this->buildClassPath($fragments)]);

          return parent::loadClass($class);
     }




    /**
      * @inheritDoc
     */
     public function getNamespaces(): array
     {
         return $this->prefixes;
     }




     /**
      * Normalize prefix namespace
      *
      * @param string $prefix
      *
      * @return string
     */
     protected function normalizeNamespace(string $prefix): string
     {
           return trim($prefix, '\\');
     }



    /**
     * @param string $path
     *
     * @return string
     */
     protected function normalizeBaseDirectory(string $path): string
     {
          return $this->locator->normalizeFile($path);
     }



     /**
      * @param string $class
      * @return string[]
     */
     private function getClassFragments(string $class): array
     {
          return explode('\\', $class);
     }




     /**
      * @param array $fragments
      *
      * @return string
     */
     private function buildClassPath(array $fragments): string
     {
           return join(DIRECTORY_SEPARATOR, $fragments);
     }
}