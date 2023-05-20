<?php
namespace Laventure\Component\Routing\Route\Contract;


/**
 * @RouteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Routing\Route\Contract
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
      * @param string $requestMethod
      *
      * @param string $requestPath
      *
      * @return bool
     */
     public function match(string $requestMethod, string $requestPath): bool;
}