<?php
namespace Laventure\Component\Templating\Cache;

/**
 * @TemplateCache
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Templating\Cache
*/
class TemplateCache implements TemplateCacheInterface
{

     /**
      * @var string
     */
     protected $cacheDir;




     /**
      * @param string $cacheDir
     */
     public function __construct(string $cacheDir)
     {
         $this->cacheDir = realpath(rtrim($cacheDir));
     }
}