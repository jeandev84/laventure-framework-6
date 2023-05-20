<?php
namespace Laventure\Component\Filesystem\Locator;


/**
 * @FileLocator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\Locator
*/
interface FileLocatorInterface
{

    /**
     * Localize full path of given filename
     *
     * @param string $filename
     *
     * @return string
    */
    public function locateFile(string $filename): string;
}