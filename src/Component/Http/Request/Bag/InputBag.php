<?php
namespace Laventure\Component\Http\Request\Bag;

use Laventure\Component\Http\Bag\ParameterBag;


/**
 * @InputBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Bag
*/
class InputBag extends ParameterBag
{

    public function __construct(array $params = [])
    {
        parent::__construct($params);
    }



    /**
     * @param string $name
     *
     * @param string $default
     *
     * @return string
    */
    public function string(string $name, string $default = ''): string
    {
        return (string)$this->get($name, $default);
    }




    /**
     * Force value to integer
     *
     * @param string $name
     * @param int $default
     * @return int
    */
    public function integer(string $name, int $default = 0): int
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
    public function float(string $name, float $default = 0): float
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
    public function boolean(string $name, bool $default = false): bool
    {
        return (bool)$this->get($name, $default);
    }




    /**
     * @return false|string
    */
    public function asJson(): bool|string
    {
        $json = json_encode($this->params, JSON_PRETTY_PRINT);

        if (json_last_error()) {
            trigger_error(json_last_error_msg());
        }

        return $json;
    }






    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->all();
    }
}