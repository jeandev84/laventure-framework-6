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
     public function __construct()
     {
         parent::__construct(getallheaders());
     }



     /**
      * @return bool
     */
     public function isNotXFormUrlEncoded(): bool
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