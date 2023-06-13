<?php
namespace Laventure\Component\Http\Message\Stream;

class TempFile extends Stream
{
    public function __construct()
    {
        parent::__construct(tmpfile());
    }
}