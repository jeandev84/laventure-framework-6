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
      * @return string
     */
     public function getDriverName(): string;




     /**
      * Returns host name
      *
      * @return string
     */
     public function getHostname(): string;





     /**
      * Returns port
      *
      * @return string|null
     */
     public function getPort(): ?string;





     /**
      * Returns name of database
      *
      * @return string|null
     */
     public function getDatabase(): ?string;





     /**
      * @return string|null
     */
     public function getUsername(): ?string;




     /**
      * @return string|null
     */
     public function getPassword(): ?string;




     /**
      * @return string|null
     */
     public function getCollation(): ?string;





     /**
      * @return string|null
     */
     public function getEngine(): ?string;





     /**
      * @return string|null
     */
     public function getPrefix(): ?string;





     /**
      * @return array
     */
     public function getOptions(): array;




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






    /**
     * @param array $params
     *
     * @return $this
    */
    public function merge(array $params): static;

}