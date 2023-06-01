<?php
namespace Laventure\Component\Http\Request\Parser;

interface UrlParserInterface
{
     /**
      * @param string $url
      *
      * @return mixed
     */
     public function parseUrl(string $url);
}