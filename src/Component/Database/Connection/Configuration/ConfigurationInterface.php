<?php
namespace Laventure\Component\Database\Connection\Configuration;


/**
 * @ConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Database\Connection\Configuration
*/
interface ConfigurationInterface extends \ArrayAccess
{

     /**
      * Returns host name
      *
      * @return string
     */
     public function getHost(): string;




     /**
      * Returns port
      *
      * @return string
     */
     public function getPort(): string;





     /**
      * Returns name of database
      *
      * @return string
     */
     public function getDatabase(): string;





     /**
      * @param array $params
      *
      * @return $this
     */
     public function merge(array $params): static;





     /**
      * Returns value of given name
      *
      * @param string $name
      *
      * @param $default
      *
      * @return mixed
     */
     public function get(string $name, $default = null);





     /**
      * Determine
      *
      * @param string $name
      *
      * @return bool
     */
     public function has(string $name): bool;






     /**
      * Returns all configuration params
      *
      * @return array
     */
     public function all(): array;
}