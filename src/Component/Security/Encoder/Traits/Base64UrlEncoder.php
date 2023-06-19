<?php
namespace Laventure\Component\Security\Encoder\Traits;


/**
 * @Base64UrlEncoder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Security\Encoder\Traits
*/
trait Base64UrlEncoder
{

     /**
      * @param string $string
      *
      * @return string
     */
     private function encodeBase64Url(string $string): string
     {
         return str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($string));
     }




     /**
      * @param string $string
      *
      * @return string
     */
     private function decodeBase64Url(string $string): string
     {
         return base64_decode(str_replace(["-", '_'], ["+", "/"], $string));
     }
}