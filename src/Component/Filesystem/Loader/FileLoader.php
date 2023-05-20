<?php
namespace Laventure\Component\Filesystem\Loader;


use Laventure\Component\Filesystem\Loader\Contract\FileLoaderInterface;
use Laventure\Component\Filesystem\Locator\FileLocator;

/**
 * @FileLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\Loader
*/
class FileLoader implements FileLoaderInterface
{

     /**
      * @param FileLocator $locator
     */
     public function __construct(protected FileLocator $locator)
     {
     }



     /**
      * @inheritDoc
     */
     public function loadFile(string $filename): mixed
     {
          if (! $this->locator->exists($filename)) {
               return false;
          }

          return require_once $this->locator->locateFile($filename);
     }
}