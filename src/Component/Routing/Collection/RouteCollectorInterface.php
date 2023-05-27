<?php
namespace Laventure\Component\Routing\Collection;


/**
 * @RouteCollectorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Collection
*/
interface RouteCollectorInterface
{

    /**
     * Map routes called by any request
     *
     * @param $methods
     *
     * @param $path
     *
     * @param $action
     *
     * @return mixed
    */
    public function map($methods, $path, $action);




    /**
     * Map route called by method GET
     *
     * @param $path
     *
     * @param $action
     *
     * @return mixed
    */
    public function get($path, $action);






    /**
     * Map route called by method POST
     *
     * @param $path
     *
     * @param $action
     *
     * @return mixed
    */
    public function post($path, $action);





    /**
     * Map route called by method PUT
     *
     * @param $path
     *
     * @param $action
     *
     * @return mixed
    */
    public function put($path, $action);





    /**
     * Map route called by method PATCH
     *
     * @param $path
     *
     * @param $action
     *
     * @return mixed
    */
    public function patch($path, $action);





    /**
     * Map route called by method DELETE
     *
     * @param $path
     *
     * @param $action
     *
     * @return mixed
     */
    public function delete($path, $action);
}