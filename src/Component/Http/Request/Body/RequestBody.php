<?php
namespace Laventure\Component\Http\Request\Body;

use Laventure\Component\Http\Message\StreamInterface;
use Laventure\Component\Http\Stream\Stream;


/**
 * @ResponseBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\Body
*/
class RequestBody extends Stream
{
    public function __construct()
    {
        parent::__construct('php://input', 'r');
    }



    /**
     * @return mixed
    */
    public function getData(): mixed
    {
        $content = $this->__toString();

        parse_str($content, $data);

        return $data;
    }


    /**
     * @return mixed
    */
    public function toArray(): mixed
    {
         $content = $this->__toString();

         if (json_last_error()) {
              trigger_error(json_last_error_msg());
         }

         if(! $data =  json_decode($content, true)) {
              return [];
         }

         return $data;
    }


    /**
     * @return bool
    */
    public function isEmpty(): bool
    {
         return is_null($this->__toString());
    }
}