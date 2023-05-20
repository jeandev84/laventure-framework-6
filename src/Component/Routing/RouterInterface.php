<?php
namespace Laventure\Component\Routing;

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
      * @param string $requestMethod
      *
      * @param string $requestUri
      *
      * @return bool
     */
     public function match(string $requestMethod, string $requestUri): bool;




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