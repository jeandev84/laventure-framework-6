<?php
namespace Laventure\Component\Message\Http\Convertor;

interface ParameterConvertorInterface
{
      /**
       * Convert parameter
       *
       * @param $name
       *
       * @return mixed
      */
      public function convertParameter($name);
}