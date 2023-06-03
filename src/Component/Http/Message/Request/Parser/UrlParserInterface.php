<?php
namespace Laventure\Component\Http\Message\Request\Parser;

interface UrlParserInterface
{
     /**
      * @param string $url
      *
      * @return mixed
     */
     public function parseUrl(string $url);
}