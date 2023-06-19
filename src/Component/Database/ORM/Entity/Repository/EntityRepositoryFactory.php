<?php
namespace Laventure\Component\Database\ORM\Entity\Repository;

/**
 * @EntityRepositoryFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Entity\Repository
*/
abstract class EntityRepositoryFactory
{
    /**
     * @param string $class
     *
     * @return EntityRepositoryInterface
    */
    abstract public function createRepository(string $class): EntityRepositoryInterface;
}