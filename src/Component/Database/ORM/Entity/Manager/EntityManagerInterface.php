<?php
namespace Laventure\Component\Database\ORM\Entity\Manager;

use Laventure\Component\Database\ORM\Entity\Repository\ServiceEntityRepository;

interface EntityManagerInterface
{

     /**
      * @return mixed
     */
     public function getClassName();


     /**
      * @param string $classname
      *
      * @return ServiceEntityRepository
     */
     public function getRepository(string $classname): ServiceEntityRepository;
}