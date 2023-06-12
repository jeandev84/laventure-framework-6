<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

use Laventure\Component\Http\Message\Stream\Stream;


class cUrlStream extends Stream
{
     /**
      * @param $stream
      *
      * @param string|null $accessMode
     */
     public function __construct($stream, string $accessMode = null)
     {
         parent::__construct($stream, $accessMode);
     }





    /**
     * @inheritdoc
    */
    public function getSize(): int
    {
        if (is_file($this->stream)) {
           return filesize($this->stream);
        }

        return parent::getSize();
    }
}