<?php
namespace Laventure\Component\Http\Request\Bag;

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
 * @package Laventure\Component\Http\Request\Bag
*/
class RequestHeaderBag extends ParameterBag
{

     private $formEncoded = [
         'application/x-www-form-urlencoded',
         'multipart/form-data'
     ];


     public function __construct()
     {
         parent::__construct(getallheaders());
     }




     /**
      * @return bool
     */
     public function encodedForm(): bool
     {
         foreach ($this->formEncoded as $encoding) {
             if (stripos($this->getContentType(), $encoding) === 0) {
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
         return (stripos($this->getContentType(), 'application/x-www-form-urlencoded') === 0);
     }




     /**
      * @return string
     */
     public function getContentType(): string
     {
         return $this->get('Content-Type', '');
     }
}