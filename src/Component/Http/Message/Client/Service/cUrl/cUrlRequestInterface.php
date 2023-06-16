<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;


/**
 * @cUrlRequestInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client\Service\cUrl
*/
interface cUrlRequestInterface
{

     /**
      * Initialize curl
      *
      * @param string|null $url
      *
      * @return mixed
     */
     public function init(string $url = null): static;




     /**
      * Set curl option
      *
      * @param array $options
      *
      * @return mixed
     */
     public function setOptions(array $options): static;




     /**
      * Execute curl handler
      *
      * @return mixed
     */
     public function exec();






     /**
      * Close curl handler request
      *
      * @return mixed
     */
     public function close();





     /**
      * Returns error
      *
      * @return mixed
     */
     public function error();

}