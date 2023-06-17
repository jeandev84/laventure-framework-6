<?php
namespace Laventure\Component\Message\Http\Storage;


/**
 * @StorageInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Message\Http\Storage
*/
interface StorageInterface
{

      /**
       * Returns value from storage given key
       *
       * @param $key
       *
       * @return mixed
      */
      public function get($key);




      /**
       * Determine if the value of given key has been stored
       *
       * @param $key
       *
       * @return bool
      */
      public function has($key): bool;




      /**
       * Remove value of given key from storage
       *
       * @param $key
       *
       * @return mixed
      */
      public function remove($key);




      /**
       * Remove all stored data from storage
       *
       * @return mixed
      */
      public function clear();




      /**
       * Returns all stored data in the storage
       *
       * @return mixed
      */
      public function all();
}