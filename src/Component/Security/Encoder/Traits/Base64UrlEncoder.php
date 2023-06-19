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
     private function encodeUrl(string $string): string
     {
         return str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($string));
     }




     /**
      * @param string $string
      *
      * @return string
     */
     private function decodeUrl(string $string): string
     {
         return base64_decode(str_replace(["-", '_'], ["+", "/"], $string));
     }




     /**
      * @param array $data
      *
      * @return string
     */
     private function encodeUrlAsJson(array $data): string
     {
          return $this->encodeUrl(json_encode($data));
     }




     /**
      * @param string $json
      *
      * @return array
     */
     private function decodeUrlFromJson(string $json): array
     {
         return json_decode($this->decodeUrl($json), true);
     }

}