<?php
namespace Laventure\Component\Routing\Route;


/**
 * @RouteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route
*/
interface RouteInterface
{


     /**
      * Return route domain or host
      *
      * @return string
     */
     public function getDomain(): string;




     /**
      * Returns route methods
      *
      * @return array
     */
     public function getMethods(): array;




     /**
      * Returns route path
      *
      * @return string
     */
     public function getPath(): string;





     /**
      * Returns route handler will be done something
      *
      *
      * @return mixed
     */
     public function getCallback(): mixed;




     /**
      * Return name of route
      *
      * @return string
     */
     public function getName();





     /**
      * Returns route pattern
      *
      * @return string
     */
     public function getPattern(): string;





     /**
      * Returns route matches params
      *
      * @return array
     */
     public function getParams(): array;





     /**
      * Return route middlewares
      *
      * @return array
     */
     public function getMiddlewares(): array;





     /**
      * Returns route options
      *
      * @return array
     */
     public function getOptions(): array;





     /**
      * Determine if the current request matches route
      *
      *
      * @param string $method (cUrlRequest method)
      *
      * @param string $path (cUrlRequest path)
      *
      * @return bool
     */
     public function match(string $method, string $path): bool;






     /**
      * Generate route uri from given params
      *
      * @param array $parameters
      *
      * @return string
    */
    public function generateURI(array $parameters = []): string;
}