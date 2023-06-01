<?php
namespace Laventure\Component\Http\Request\Body;


/**
 * @ParsedBodyInterface
 *
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\Body
*/
interface ParsedBodyInterface
{
     /**
      * Returns parsed body
      *
      * @return mixed
     */
     public function get();


     /**
      * Returns parsed body
      *
      * @return mixed
     */
     public function parseBody();
}