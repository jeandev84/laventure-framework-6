<?php
namespace Laventure\Component\Database\Connection\Extension\PDO\Drivers;

use Laventure\Component\Database\Connection\Extension\PDO\PdoConnection;

class MysqlConnection extends PdoConnection
{
     public function __construct()
     {
         parent::__construct('mysql');
     }
}