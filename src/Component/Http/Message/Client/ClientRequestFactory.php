<?php
namespace Laventure\Component\Http\Message\Client;

use Laventure\Component\Http\Message\Client\Service\cUrl\cUrlRequest;
use Laventure\Component\Http\Message\Client\Service\Stream\StreamRequest;


/**
 * @ClientRequestFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client
*/
class ClientRequestFactory
{

      /**
       * @param string $name
       *
       * @return ClientRequest
      */
      public static function create(string $name): ClientRequest
      {
           return [
               ClientRequestType::STREAM => new StreamRequest()
           ][$name] ?? new cUrlRequest();
      }
}