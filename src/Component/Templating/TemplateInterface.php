<?php
namespace Laventure\Component\Templating;


/**
 * @TemplateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating
*/
interface TemplateInterface
{

     /**
      * Returns path of template
      *
      * @return string
     */
     public function getPath(): string;




     /**
      * Returns template parameters
      *
      * @return array
     */
     public function getParameters(): array;




     /**
      * Returns template content
      *
      * @return string
     */
     public function __toString(): string;
}