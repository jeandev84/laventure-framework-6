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
       * Returns client request
       *
       * @param string|null $name
       *
       * @return ClientRequest
       *
       * @throws ClientException
      */
      public static function create(string $name = null): ClientRequest
      {
          $collection = new ClientRequestCollection();
          $collection->add(new cUrlRequest());
          $collection->add(new StreamRequest());
          return $collection->get($name ?: ClientRequestType::CURL);
      }
}