<?php
namespace Laventure\Component\Filesystem\Loader\Contract;



/**
 * @ClassLoaderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @see https://www.php-fig.org/psr/psr-4/
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\Loader\Contract
*/
interface ClassLoaderInterface
{
    /**
     * Load class
     *
     * @param string $class
     * @return mixed
    */
    public function loadClass(string $class): mixed;
}