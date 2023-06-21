<?php
namespace Laventure\Component\Database\Connection\Configuration;


/**
 * @Configuration
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Configuration
*/
class Configuration implements ConfigurationInterface
{
     /**
      * @var array
     */
     protected $params = [];



     /**
      * @param array $params
     */
     public function __construct(array $params)
     {
         $this->merge($params);
     }



     /**
      * @inheritDoc
     */
     public function getHost(): string
     {
        // TODO: Implement getHost() method.
     }



     /**
      * @inheritDoc
     */
     public function getPort(): string
     {
        // TODO: Implement getPort() method.
     }




     /**
      * @inheritDoc
     */
     public function getDatabase(): string
     {
        // TODO: Implement getDatabase() method.
     }




    /**
     * @param array $params
     *
     * @return $this
    */
    public function merge(array $params): static
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }


     /**
      * @inheritDoc
     */
     public function get(string $name, $default = null)
     {
        // TODO: Implement get() method.
     }





     /**
      * @inheritDoc
     */
     public function has(string $name): bool
     {
         return isset($this->params[$name]);
     }




     /**
     * @inheritDoc
     */
    public function all(): array
    {
        // TODO: Implement all() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
        // TODO: Implement offsetUnset() method.
    }
}