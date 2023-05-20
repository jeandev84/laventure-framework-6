<?php
namespace Laventure\Component\Filesystem\Loader\Contract;


/**
 * @NamespaceLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @see https://www.php-fig.org/psr/psr-4/
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Filesystem\Loader\Contract
*/
interface NamespaceLoaderInterface extends ClassLoaderInterface
{
    /**
     * Returns all registered prefixes
     *
     * @return array
    */
    public function getNamespaces(): array;
}