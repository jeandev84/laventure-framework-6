<?php
namespace Laventure\Component\Routing\Route;



/**
 * @RouteParameter
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
*/
class RouteParameter
{


    /**
     * @param string $methods
     *
     * @param string $path
     *
     * @param mixed $action
    */
    public function __construct(protected string $methods, protected string $path, protected mixed $action)
    {

    }



    /**
     * @return string
    */
    public function getMethods(): string
    {
        return $this->methods;
    }



    /**
     * @return string
    */
    public function getPath(): string
    {
        return $this->path;
    }





    /**
     * @return mixed
    */
    public function getAction(): mixed
    {
        return $this->action;
    }
}