<?php
namespace Laventure\Component\Message\Http\Storage\Session;


/**
 * @StorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Message\Http\Storage
*/
interface FlashInterface
{

    /**
     * @param string $flashKey
     *
     * @return mixed
    */
    public function setFlashSessionKey(string $flashKey);




    /**
     * Add flash in the session
     *
     * @param string $key
     *
     * @param $value
     *
     * @return mixed
    */
    public function addFlash(string $key, $value);





    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getFlash(string $key);




    /**
     * Determine if the given key has been flashed
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasFlash(string $key);






    /**
     * Returns all flashes
     *
     * @return mixed
    */
    public function getFlashes();





    /**
     * Remove all flashes
     *
     * @return mixed
    */
    public function clearFlashes();
}