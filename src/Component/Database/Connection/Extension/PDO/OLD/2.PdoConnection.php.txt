<?php
namespace Laventure\Component\Database\Connection\Extension\PDO;

use Laventure\Component\Database\Connection\Extension\PDO\Contract\PdoConnectionInterface;
use Laventure\Component\Database\Connection\Extension\PDO\Exception\PdoConnectionException;
use PDO;
use PDOException;

/**
 * @PdoConnection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Extension\PDO
*/
class PdoConnection implements PdoConnectionInterface
{

    /**
     * @var PDO
    */
    protected PDO $pdo;



    /**
     * @var array
    */
    protected $options = [
        PDO::ATTR_PERSISTENT          => true,
        PDO::ATTR_EMULATE_PREPARES    => 0,
        PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION
    ];




    /**
     * @param array $config
     *
     * @return PDO
     *
     * @throws PdoConnectionException
    */
    public static function make(array $config)
    {
        try {
            return new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);
        } catch (PDOException $exception) {
            throw new PdoConnectionException($exception->getMessage());
        }
    }



//    /**
//     * @param array $config
//     *
//     * @return PDO
//     *
//     * @throws PdoConnectionException
//    */
//    public static function make(array $config): PDO
//    {
//         if (empty($config['dsn'])) {
//             $config['dsn'] = $config['driver']. ":". http_build_query($config, '', ';');
//         }
//
//         $pdo = new static($config['dsn'], $config['username'], $config['password'], $config['options']);
//
//         return $pdo->getPdo();
//    }






    /**
     * @inheritDoc
    */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}