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
      * @param string $key
      *
      * @param $value
      *
      * @return $this
     */
     public function set(string $key, $value): static
     {
         $this->params[$key] = $value;

         return $this;
     }




     /**
      * @param string $key
      *
      * @return $this
     */
     public function remove(string $key): static
     {
         unset($this->params[$key]);

         return $this;
     }




    /**
     * @inheritDoc
    */
    public function getCollation(): ?string
    {
        // TODO: Implement getCollation() method.
    }




    /**
     * @inheritDoc
    */
    public function getEngine(): ?string
    {
         return $this->get('engine', '');
    }





    /**
     * @inheritDoc
    */
    public function getPrefix(): ?string
    {
        return $this->get('prefix', '');
    }





    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->get('options', []);
    }



     /**
      * @inheritDoc
     */
     public function getHostname(): string
     {
        return $this->get('host', '');
     }




     /**
      * @inheritDoc
     */
     public function getPort(): ?string
     {
        return $this->get('port');
     }




     /**
      * @inheritDoc
     */
     public function getDatabase(): ?string
     {
         return $this->get('database');
     }



     /**
      * @inheritDoc
     */
     public function getUsername(): ?string
     {
         return $this->get('username');
     }




     /**
      * @inheritDoc
     */
     public function getPassword(): ?string
     {
        return $this->get('password');
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
          return $this->params[$name] ?? $default;
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
        return $this->params;
    }




    /**
     * @inheritDoc
    */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }





    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
         return $this->get($offset);
    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
         $this->merge([$offset => $value]);
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }
}