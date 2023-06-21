<?php
namespace Laventure\Component\Database\Manager;


use Laventure\Component\Database\Connection\Configuration\Configuration;
use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Manager\Exception\DatabaseManagerException;


/**
 * @DatabaseManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Manager
*/
class DatabaseManager
{


      /**
       * @var string
      */
      protected $connection;




      /**
       * @var ConnectionInterface[]
      */
      protected $connections = [];




      /**
       * @var array
      */
      protected $config = [];




      /**
       * @var ConnectionInterface[]
      */
      protected $connected = [];



      /**
       * @var array
      */
      protected $disconnected = [];




      /**
       * @param string $connection
       *
       * @param array $config
      */
      public function __construct(string $connection, array $config)
      {
           $this->setDefaultConnection($connection);
           $this->setConfigurations($config);
      }



      /**
       * @param string $connection
       * @return $this
      */
      public function setDefaultConnection(string $connection): static
      {
          $this->connection = $connection;

          return $this;
      }



      /**
       * @param string $name
       *
       * @param mixed $config
       *
       * @return $this
      */
      public function setConfiguration(string $name, mixed $config): static
      {
          $this->config[$name] = $config;

          return $this;
      }




      /**
       * @param array $parameters
       *
       * @return $this
      */
      public function setConfigurations(array $parameters): static
      {
           foreach ($parameters as $name => $config) {
               $this->setConfiguration($name, $config);
           }

           return $this;
      }






      /**
       * @param ConnectionInterface $connection
       *
       * @return $this
      */
      public function setConnection(ConnectionInterface $connection): static
      {
          $this->connections[$connection->getName()] = $connection;

          return $this;
      }





      /**
       * Determine if given name is available connection
       *
       * @param string $name
       *
       * @return bool
      */
      public function hasConnection(string $name): bool
      {
           return isset($this->connections[$name]);
      }






      /**
       * @param ConnectionInterface[] $connections
       *
       * @return $this
      */
      public function setConnections(array $connections): static
      {
           foreach ($connections as $connection) {
               $this->setConnection($connection);
           }

           return $this;
      }





      /**
       * @param string|null $name
       *
       * @return ConnectionInterface|null
      */
      public function connection(string $name = null): ?ConnectionInterface
      {
          $name = $name ?: $this->connection;

          $config = $this->configuration($name);

          if (! $this->hasConnection($name)) {
              $this->abortIf("unavailable connection named '$name'");
          }

          $connection = $this->connections[$name];
          $connection->connect(new Configuration($config));

          if (! $connection->connected()) {
               $this->abortIf("no connection detected for '$name'.");
          }

          return $this->connected[$name] = $connection;
      }




      /**
       * @param string $name
       * @return bool
      */
      public function connected(string $name)
      {
           return ! empty($this->connected[$name]);
      }




      /**
       * @param string $name
       *
       * @return array
      */
      public function configuration(string $name): array
      {
           if (empty($this->config[$name])) {
               $this->abortIf("empty configuration for connection '$name'.");
           }

           return $this->config[$name];
      }




      /**
       * @param string $message
       *
       * @param int $code
       *
       * @return void
       */
      private function abortIf(string $message, int $code = 500): void
      {
          (function () use ($message, $code) {
              throw new DatabaseManagerException($message, $code);
          })();
      }
}