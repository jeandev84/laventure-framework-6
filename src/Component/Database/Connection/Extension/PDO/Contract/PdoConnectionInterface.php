<?php
namespace Laventure\Component\Database\Connection\Extension\PDO\Contract;

use Laventure\Component\Database\Connection\ConnectionInterface;
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
interface PdoConnectionInterface extends ConnectionInterface
{

     /**
      * Returns PDO driver
      *
      * @return PDO
     */
     public function getPdo(): PDO;
}