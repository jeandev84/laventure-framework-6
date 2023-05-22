<?php
namespace Laventure\Component\Http;



/**
 * @ParameterBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http
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
     * @param string $key
     * @param $value
     * @return $this
    */
    public function set(string $key, $value): self
    {
        $this->params[$key] = $value;

        return $this;
    }





    /**
     * @param string $key
     * @return bool
    */
    public function has(string $key): bool
    {
        return isset($this->params[$key]);
    }






    /**
     * @param $key
     * @return bool
    */
    public function empty(string $key): bool
    {
        return empty($this->params[$key]);
    }






    /**
     * Returns param value
     *
     * @param string $key
     *
     * @param $default
     *
     * @return mixed|null
    */
    public function get(string $key, $default = null): mixed
    {
        return $this->params[$key] ?? $default;
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
     * @param string $key
     *
     * @return void
    */
    public function remove(string $key)
    {
        unset($this->params[$key]);
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
     * Parse param
     *
     * @param string $key
     *
     * @param $value
     *
     * @return $this
    */
    public function parse(string $key, $value = null): self
    {
        $this->merge(\is_array($key) ? $key : [$key => $value]);

        return $this;
    }




    /**
     * Force value to integer
     *
     * @param string $key
     * @param int $default
     * @return int
    */
    public function getInt(string $key, int $default = 0): int
    {
        return (int)$this->get($key, $default);
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