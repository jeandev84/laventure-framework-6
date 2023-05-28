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
class ParameterBag implements ParameterBagInterface
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
     * @param string $name
     * @param $value
     * @return $this
    */
    public function set(string $name, $value): mixed
    {
        $this->params[trim($name)] = trim($value);

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
     * @return $this
    */
    public function remove(string $name): mixed
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
}