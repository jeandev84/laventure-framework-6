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


    /**
     * @param $stream
     *
     * @param string $accessMode
    */
    public function __construct($stream, string $accessMode = 'r')
    {
        parent::__construct($stream, $accessMode);
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return http_get_request_body();
    }
}