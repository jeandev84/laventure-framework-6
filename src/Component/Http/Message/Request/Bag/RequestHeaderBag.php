<?php
namespace Laventure\Component\Http\Message\Request\Bag;

use Laventure\Component\Http\Bag\ParameterBag;


/**
 * @RequestHeaderBag
 *
 * @see https://www.php.net/manual/en/function.getallheaders.php
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\cUrlRequest\Bag
*/
class RequestHeaderBag extends ParameterBag
{

     private $formHeaders = [
         'application/x-www-form-urlencoded',
         'multipart/form-data'
     ];




     /**
      * @return bool
     */
     public function hasFormHeaders(): bool
     {
         foreach ($this->formHeaders as $header) {
             if (stripos($this->getContentTypeHeader(), $header) === 0) {
                   return true;
             }
         }

         return false;
     }




     /**
      * @return bool
     */
     public function hasXFormUrlEncoded(): bool
     {
         return (stripos($this->getContentTypeHeader(), 'application/x-www-form-urlencoded') === 0);
     }




     /**
      * @return string
     */
     public function getContentTypeHeader(): string
     {
         return $this->get('Content-Type', '');
     }
}