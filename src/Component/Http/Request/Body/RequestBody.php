<?php
namespace Laventure\Component\Http\Request\Body;

use Laventure\Component\Http\Message\StreamInterface;
use Laventure\Component\Http\Stream\Stream;


/**
 * @RequestBody
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
     * @inheritdoc
    */
    public function __construct($stream = null)
    {
        parent::__construct($stream ?: 'php://input');
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return http_get_request_body();
    }
}