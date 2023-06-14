<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

use Laventure\Component\Http\Message\Client\Service\HttpResponse;
use Laventure\Component\Http\Message\Client\Service\Stream\Stream;

class cUrlResponse extends HttpResponse
{
      /**
       * @param Stream $stream
       *
       * @return $this
      */
      public function download(Stream $stream): static
      {
           $stream->write($this->body);

           return $this;
      }
}