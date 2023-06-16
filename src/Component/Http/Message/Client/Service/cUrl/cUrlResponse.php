<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

use Laventure\Component\Http\Message\Client\ClientResponse;
use Laventure\Component\Http\Message\Client\Service\Stream\Stream;

class cUrlResponse extends ClientResponse
{

    /**
     * @param Stream $stream
     *
     * @return $this
    */
    public function downloadBody(Stream $stream): static
    {
        $stream->write($this->body);

        return $this;
    }
}