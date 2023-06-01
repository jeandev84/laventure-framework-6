<?php

namespace Laventure\Component\Templating\Extension;

interface TemplateExtensionInterface
{
     /**
      * @return array
     */
     public function getFunctions(): array;


     /**
      * @return array
     */
     public function getFilters(): array;
}