<?php
namespace Laventure\Component\Http\Message\Client;

interface ClientRequestInterface
{
     /**
      * Returns client request url
      *
      * @return string|null
     */
     public function getUrl(): ?string;
}