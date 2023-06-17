<?php
namespace Laventure\Component\Http\Bag;



/**
 * @ParameterBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Bag
*/
class ParameterBag implements ParameterBagInterface, \ArrayAccess
{


    /**
     * @var array
    */
    protected $params = [];




    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        $this->merge($params);
    }



    /**
     * Set params
     *
     * @param $name
     * @param $value
     * @return $this
    */
    public function set($name, $value): mixed
    {
        $this->params[$name] = $value;

        return $this;
    }






    /**
     * @param $name
     * @return bool
    */
    public function has($name): bool
    {
        return isset($this->params[$name]);
    }



    /**
     * @param string $name
     *
     * @return bool
    */
    public function empty(string $name): bool
    {
        return empty($this->params[$name]);
    }






    /**
     * Returns param value
     *
     * @param string $name
     *
     * @param $default
     *
     * @return mixed|null
    */
    public function get(string $name, $default = null): mixed
    {
        return $this->params[$name] ?? $default;
    }



    /**
     * @return int[]|string[]
    */
    public function keys(): array
    {
        return array_keys($this->params);
    }


    /**
     * @return array
    */
    public function values(): array
    {
        return array_values($this->params);
    }



    /**
     * Returns all params
     *
     * @return array
    */
    public function all(): array
    {
        return $this->params;
    }






    /**
     * Merge params
     *
     * @param array $params
     *
     * @return $this
    */
    public function merge(array $params): self
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }





    /**
     * Remove param by given key
     *
     * @param $name
     *
     * @return mixed
    */
    public function remove($name): mixed
    {
        unset($this->params[$name]);

        return $this;
    }




    /**
     * Clean all params
     *
     * @return void
    */
    public function clear(): void
    {
        $this->params = [];
    }




    /**
     * Refresh params
     *
     * @param array $params
     *
     * @return $this
    */
    public function rewind(array $params): static
    {
         $this->clear();

         $this->merge($params);

         return $this;
    }






    /**
     * @param string|array $name
     *
     * @param null $value
     *
     * @return $this
     */
    public function parseParams(string|array $name, $value = null): self
    {
        $this->merge(\is_array($name) ? $name : [$name => $value]);

        return $this;
    }




    /**
     * @param string $name
     *
     * @param string $default
     *
     * @return string
     */
    public function toUpper(string $name, string $default = ''): string
    {
        return mb_strtoupper($this->get($name, $default));
    }





    /**
     * @param string $name
     *
     * @param string $default
     *
     * @return string
    */
    public function toLower(string $name, string $default = ''): string
    {
        return mb_strtolower($this->get($name, $default));
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
         $this->set($offset, $value);
    }




    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }
}