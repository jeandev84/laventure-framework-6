<?php
namespace Laventure\Component\Http\Message\Request\Body;

use Laventure\Component\Http\Message\Stream\Stream;


/**
 * @ResponseBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\cUrlRequest\Body
*/
class RequestBody extends Stream
{
    public function __construct()
    {
        parent::__construct('php://input', 'r');
    }
}