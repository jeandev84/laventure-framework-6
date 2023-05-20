<?php
namespace Laventure\Component\Filesystem\Loader;

use Laventure\Component\Filesystem\Loader\Contract\ClassLoaderInterface;


/**
 * @inheritDoc
*/
class ClassLoader extends FileLoader implements ClassLoaderInterface
{

    /**
     * @inheritDoc
    */
    public function loadClass(string $class): mixed
    {
        return $this->loadFile("$class.php");
    }



    /**
     * @param array $classes
     *
     * @return void
    */
    public function loadClasses(array $classes): void
    {
         foreach ($classes as $class) {
              $this->loadClass($class);
         }
    }
}