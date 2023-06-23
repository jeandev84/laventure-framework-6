<?php
namespace Laventure\Component\Database\Connection\Extension\PDO;

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
     * @var array
    */
    private static $options = [
        PDO::ATTR_PERSISTENT          => true,
        PDO::ATTR_EMULATE_PREPARES    => 0,
        PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION
    ];




    /**
     * @var ConfigurationInterface
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
    public function connect(ConfigurationInterface $config)
    {
        $config['dsn'] = $this->createDsn($config);
        $this->pdo     = $this->make($config);
        $this->config  = $config;
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
             $this->config['dsn'] .= [];
         }
    }



    /**
     * @inheritDoc
    */
    public function reconnected(): bool
    {
        // TODO: Implement reconnected() method.
    }



    /**
     * @inheritDoc
    */
    public function disconnect()
    {
        // TODO: Implement disconnect() method.
    }



    /**
     * @inheritDoc
    */
    public function disconnected(): bool
    {
        // TODO: Implement disconnected() method.
    }



    /**
     * @inheritDoc
     */
    public function statement(string $sql): QueryInterface
    {
        // TODO: Implement statement() method.
    }

    /**
     * @inheritDoc
     */
    public function beginTransaction()
    {
        // TODO: Implement beginTransaction() method.
    }

    /**
     * @inheritDoc
     */
    public function commit()
    {
        // TODO: Implement commit() method.
    }

    /**
     * @inheritDoc
    */
    public function rollback()
    {
        // TODO: Implement rollback() method.
    }



    /**
     * @inheritDoc
    */
    public function lastInsertId($name = null): int
    {
        // TODO: Implement lastInsertId() method.
    }



    /**
     * @inheritDoc
    */
    public function exec(string $sql): bool
    {
        // TODO: Implement exec() method.
    }




    /**
     * @inheritDoc
    */
    public function getConnection()
    {
        // TODO: Implement getConnection() method.
    }



    /**
     * @inheritDoc
    */
    public function createQuery(): QueryInterface
    {
        // TODO: Implement createQuery() method.
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
            $pdo     = new PDO($config['dsn'], $config['username'], $config['password']);
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




    /**
     * @param ConfigurationInterface $config
     *
     * @return string
     *
     * @throws PdoConnectionException
    */
    private function createDsn(ConfigurationInterface $config): string
    {
        if ($config->has('dsn')) {
             return $config['dsn'];
        }

        $driver = $config->get('driver', $this->getName());

        if (! $driver) {
            throw new PdoConnectionException("No driver provided from configuration.");
        }

        if (! in_array($driver, \PDO::getAvailableDrivers())) {
            throw new PdoConnectionException("Unavailable driver '$driver'");
        }

        $params = [
            'host' => $config->getHostname(),
            'port' => $config->getPort()
        ];

        return sprintf('%s:%s', $driver, http_build_query($params, '', ';'));
    }
}