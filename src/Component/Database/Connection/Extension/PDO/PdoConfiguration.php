<?php
namespace Laventure\Component\Database\Connection\Extension\PDO;

use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\Configuration\ConfigurationInterface;
use Laventure\Component\Database\Connection\Extension\PDO\Exception\PdoConnectionException;


class PdoConfiguration extends Configuration
{

    /**
     * @var string
    */
    protected string $dsn;


    /**
     * @param array $params
    */
    public function __construct(array $params)
    {
        parent::__construct($params);
    }




    /**
     * @param string $dsn
     *
     * @return $this
    */
    public function setDsn(string $dsn): static
    {
        $this->dsn = $dsn;

        return $this;
    }





    /**
     * @param string $driver
     *
     * @return $this
     *
     * @throws PdoConnectionException
    */
    public function setDriverName(string $driver): static
    {
        if (! $driver) {
            throw new PdoConnectionException("No driver provided from configuration.");
        }

        if (! in_array($driver, \PDO::getAvailableDrivers())) {
            throw new PdoConnectionException("Unavailable driver '$driver'");
        }

        $dsn = sprintf('%s:%s', $driver,  $this->buildDsnParams([
            'host' => $this->getHostname(),
            'port' => $this->getPort()
        ]));

        return $this->setDsn($dsn);
    }




    /**
     * @return string
    */
    public function getDsn(): string
    {
        return $this->dsn;
    }




    /**
     * @return $this
    */
    public function refreshDsn(): static
    {
         $dsn = $this->getDsn();

         $dsn .= ';'. $this->getDatabase();

         return $this->setDsn($dsn);
    }




    /**
     * @param array $params
     *
     * @return string
    */
    private function buildDsnParams(array $params): string
    {
        return http_build_query($params, '', ';');
    }
}