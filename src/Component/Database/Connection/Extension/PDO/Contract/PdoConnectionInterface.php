<?php
namespace Laventure\Component\Database\Connection\Extension\PDO\Contract;

use PDO;


/**
 * @PdoConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extension\PDO\Contract
*/
interface PdoConnectionInterface
{

     /**
      * Returns PDO driver
      *
      * @return PDO
     */
     public function getPdo(): PDO;
}