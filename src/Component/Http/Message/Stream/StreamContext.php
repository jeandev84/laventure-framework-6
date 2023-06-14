<?php
namespace Laventure\Component\Http\Message\Stream;

class StreamContext
{

     /**
      * @return resource
     */
     public static function create(array $options = [])
     {
         return stream_context_create($options);
     }
}