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
class ParameterBag
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
        $this->params = $params;
    }






    /**
     * Set params
     *
     * @param string $name
     * @param $value
     * @return $this
    */
    public function set(string $name, $value): self
    {
        $this->params[$name] = $value;

        return $this;
    }





    /**
     * @param string $name
     * @return bool
    */
    public function has(string $name): bool
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
     * @param string $name
     *
     * @return void
    */
    public function remove(string $name): void
    {
        unset($this->params[$name]);
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
     * @return void
    */
    public function refresh(array $params)
    {
        // todo implements
    }


    /**
     * @param string|array $name
     *
     * @param null $value
     *
     * @return $this
     */
    public function parse(string|array $name, $value = null): self
    {
        $this->merge(\is_array($name) ? $name : [$name => $value]);

        return $this;
    }




    /**
     * Force value to integer
     *
     * @param string $name
     * @param int $default
     * @return int
    */
    public function getInt(string $name, int $default = 0): int
    {
        return (int)$this->get($name, $default);
    }





    /**
     * @param string $name
     *
     * @param float $default
     *
     * @return float
    */
    public function getFloat(string $name, float $default = 0): float
    {
        return (float)$this->get($name, $default);
    }





    /**
     * @param string $name
     *
     * @param bool $default
     *
     * @return bool
    */
    public function getBoolean(string $name, bool $default = false): bool
    {
        return (bool)$this->get($name, $default);
    }
}