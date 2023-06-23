<?php
namespace Laventure\Component\Database\Connection;

use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Query\Contract\QueryInterface;



/**
 * @ConnectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection
*/
interface ConnectionInterface
{

    /**
     * Returns connection name
     *
     * @return string
    */
    public function getName(): string;





    /**
     * Connect to the database
     *
     * @param ConfigurationInterface $config
     *
     * @return mixed
    */
    public function connect(ConfigurationInterface $config);






    /**
     * Determine if the connection established
     *
     * @return bool
    */
    public function connected(): bool;







    /**
     * Reconnection to the database
     *
     * @return mixed
    */
    public function reconnect();







    /**
     * Disconnect to the database
     *
     * @return mixed
    */
    public function disconnect();






    /**
     * Determine if connection is not established
     *
     * @return bool
    */
    public function disconnected(): bool;






    /**
     * Prepare query
     *
     * @param string $sql
     *
     * @return QueryInterface
    */
    public function statement(string $sql): QueryInterface;






    /**
     * Begin a transaction query
     *
     * @return mixed
    */
    public function beginTransaction();





    /**
     * Commit transaction
     *
     * @return mixed
    */
    public function commit();





    /**
     * Rollback transaction
     *
     * @return mixed
    */
    public function rollback();






    /**
     * Get last insert id
     *
     * @param $name
     *
     * @return int
    */
    public function lastInsertId($name = null): int;






    /**
     * Execute query
     *
     * @param string $sql
     *
     * @return bool
    */
    public function exec(string $sql): bool;







    /**
     * Returns connection driver
     *
     * @return mixed
    */
    public function getConnection();






    /**
     * Create a new query
     *
     * @return QueryInterface
    */
    public function createQuery(): QueryInterface;





    /**
     * Determine if database exist
     *
     * @return bool
    */
    public function hasDatabase(): bool;





    /**
     * Returns configuration object
     *
     * @return ConfigurationInterface
    */
    public function getConfiguration(): ConfigurationInterface;
}