<?php
namespace Laventure\Component\Filesystem\Loader\Contract;


/**
 * @FileLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\Loader\Contract
*/
interface FileLoaderInterface
{
     /**
      * @param string $filename
      *
      * @return mixed
     */
     public function loadFile(string $filename): mixed;
}