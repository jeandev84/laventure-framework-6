<?php
namespace Laventure\Component\Http\Message\Response\Body;

use Laventure\Component\Http\Message\Stream\Stream;


/**
 * @ResponseBody
 *
 * @link http://php.adamharvey.name/manual/fr/function.http-get-request-body.php
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Response\Body
*/
class ResponseBody extends Stream
{


    /**
     * @param $stream
     *
     * @param string $accessMode
    */
    public function __construct($stream, string $accessMode = 'w')
    {
        parent::__construct($stream, $accessMode);
    }



    /**
     * @inheritdoc
    */
    public function __toString()
    {
        return  "";
    }



    /**
     * @return resource|null
    */
    public function getResponseFromStream()
    {
        return http_get_request_body_stream();
    }
}