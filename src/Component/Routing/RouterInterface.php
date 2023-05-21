<?php
namespace Laventure\Component\Routing;



/**
 * @RouterInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing
*/
interface RouterInterface
{


     /**
      * Returns route collection
      *
      * @return mixed
     */
     public function getRoutes();





     /**
      * Determine if the current request matches route
      *
      *
      * @param string $method request method
      *
      * @param string $path request path
      *
      * @return mixed
     */
     public function match(string $method, string $path);




     /**
      * Return the path of route by given name
      *
      * @param string $name
      *
      * @param array $parameters
      *
      * @return mixed
     */
     public function generate(string $name, array $parameters = []);
}