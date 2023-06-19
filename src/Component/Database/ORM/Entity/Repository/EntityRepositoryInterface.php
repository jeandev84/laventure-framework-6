<?php
namespace Laventure\Component\Database\ORM\Entity\Repository;

/**
 * @EntityRepositoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\ORM\Entity\Repository
*/
interface EntityRepositoryInterface
{


       /**
        * Returns one record by given id
        *
        * @param $id
        *
        * @return object|null
      */
      public function find($id);





      /**
       * Return one record by given criteria
       *
       * @param array $criteria
       *
       * @param array|null $oderBy
       *
       * @return object|null
      */
      public function findOneBy(array $criteria, array $oderBy = null);






      /**
       * Returns all records
       *
       * @return object[]
      */
      public function findAll();





      /**
       * Returns all records by given criteria
       *
       * @param array $criteria
       *
       * @param array|null $orderBy
       *
       * @param int|null $limit
       *
       * @param int|null $offset
       *
       * @return object[]
      */
      public function findBy(array $criteria, array $orderBy = null, int $limit = null, int $offset = null);
}