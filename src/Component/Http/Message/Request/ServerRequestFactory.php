<?php
namespace Laventure\Component\Http\Message\Request;


use Laventure\Component\Http\Message\Request\Contract\ServerRequestInterface;

/**
 * @ServerRequestFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Request
*/
class ServerRequestFactory
{

     /**
      * @return ServerRequestInterface
     */
     public static function fromGlobals(): ServerRequestInterface
     {
        return new ServerRequest($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER);
     }
}