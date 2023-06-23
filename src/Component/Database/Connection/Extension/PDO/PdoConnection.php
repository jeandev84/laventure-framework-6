<?php
namespace Laventure\Component\Database\Connection\Extension\PDO;

use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extension\PDO\Contract\PdoConnectionInterface;
use Laventure\Component\Database\Connection\Extension\PDO\Exception\PdoConnectionException;
use Laventure\Component\Database\Connection\Query\Contract\QueryInterface;
use PDO;


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
     * Driver name
     *
     * @var string
    */
    protected $driver;




    /**
     * @var PDO
    */
    protected $pdo;




    /**
     * @var bool
    */
    protected bool $reconnected = false;



    /**
     * @var array
    */
    private static $options = [
        PDO::ATTR_PERSISTENT          => true,
        PDO::ATTR_EMULATE_PREPARES    => 0,
        PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION
    ];




    /**
     * @var PdoConfiguration
    */
    protected $config;




    /**
     * @param string $driver
    */
    public function __construct(string $driver)
    {
         $this->driver = $driver;
    }





    /**
     * @inheritdoc
     *
     * @throws PdoConnectionException
    */
    public function connect(array $config)
    {
        $this->config = new PdoConfiguration($config);
        $this->config->setDriverName($this->getName());
        $this->pdo    = static::make($this->config);
    }





    /**
     * @inheritDoc
    */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }






    /**
     * @inheritDoc
    */
    public function getName(): string
    {
         return $this->driver;
    }




    /**
     * @inheritDoc
    */
    public function connected(): bool
    {
        return $this->pdo instanceof PDO;
    }



    /**
     * @inheritDoc
    */
    public function reconnect()
    {
         if ($this->connected()) {
             $this->config->refreshDsn();
             $this->pdo = static::make($this->config);
             $this->reconnected = true;
         }
    }




    /**
     * @inheritDoc
    */
    public function reconnected(): bool
    {
        return $this->reconnected;
    }





    /**
     * @inheritDoc
    */
    public function disconnect()
    {
        $this->pdo = null;
    }




    /**
     * @inheritDoc
    */
    public function disconnected(): bool
    {
         return is_null($this->pdo);
    }





    /**
     * @inheritDoc
     */
    public function statement(string $sql): QueryInterface
    {
         $statement = $this->createQuery();
         $statement->prepare($sql);
         return $statement;
    }




    /**
     * @inheritDoc
    */
    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }




    /**
     * @inheritDoc
    */
    public function commit()
    {
        return $this->pdo->commit();
    }




    /**
     * @inheritDoc
    */
    public function rollback()
    {
        return $this->pdo->rollBack();
    }




    /**
     * @inheritDoc
    */
    public function lastInsertId($name = null): int
    {
        return $this->pdo->lastInsertId($name);
    }





    /**
     * @inheritDoc
    */
    public function exec(string $sql): bool
    {
        return $this->pdo->exec($sql);
    }




    /**
     * @inheritDoc
    */
    public function getConnection()
    {
        return $this->getPdo();
    }





    /**
     * @inheritDoc
    */
    public function createQuery(): QueryInterface
    {
         return new Statement($this->getPdo());
    }





    /**
     * @inheritDoc
    */
    public function getConfiguration(): ConfigurationInterface
    {
         return $this->config;
    }




    /**
     * @param ConfigurationInterface $config
     *
     * @return PDO
     *
     * @throws PdoConnectionException
    */
    public static function make(ConfigurationInterface $config): PDO
    {
        try {
            $pdo = new PDO($config['dsn'], $config['username'], $config['password']);
            $pdo->exec("SET NAMES 'utf8'");
            $options = array_merge(self::$options, $config['options']);

            foreach ($options as $key => $value) {
                $pdo->setAttribute($key, $value);
            }

            return $pdo;

        } catch (\Exception $e) {

            throw new PdoConnectionException($e->getMessage(), $e->getCode());
        }
    }
}