<?php
namespace Laventure\Component\Http\Stream;

use InvalidArgumentException;
use Laventure\Component\Http\Message\StreamInterface;

/**
 * @Stream
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Stream
*/
class Stream implements StreamInterface
{

    /**
     * @var mixed
    */
    protected $stream;



    /**
     * @param string $stream
     *
     * @param string $accessMode
    */
    public function __construct($stream, string $accessMode = 'r')
    {
         if (! $this->streamIsFile($stream)) {
              $stream = fopen($stream, $accessMode);
         }

         $this->stream = $stream;
    }



    /**
     * @param $stream
     *
     * @return bool
    */
    public function isStream($stream): bool
    {
        return is_resource($stream) && (get_resource_type($stream) === 'stream');
    }


    /**
     * @param $stream
     *
     * @return bool
    */
    public function streamIsFile($stream): bool
    {
        return $this->isStream($stream) && is_string($stream);
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }



    /**
     * @inheritDoc
    */
    public function close(): bool
    {
        return fclose($this->stream);
    }




    /**
     * @inheritDoc
    */
    public function detach(): void
    {
        $this->stream = null;
    }




    /**
     * @inheritDoc
    */
    public function getSize(): int
    {
        return fstat($this->stream)['size'];
    }




    /**
     * @see https://www.php.net/manual/ru/function.ftell.php
     *
     * @inheritDoc
    */
    public function tell(): bool|int
    {
        return ftell($this->stream);
    }




    /**
     * @inheritDoc
    */
    public function eof(): bool
    {
        return feof($this->getStream());
    }



    /**
     * @inheritDoc
    */
    public function isSeekable()
    {
        $meta = $this->getMetadata();

        return $meta['seekable'];
    }




    /**
     * @inheritDoc
    */
    public function seek($offset, $whence = SEEK_SET): int
    {
         return fseek($this->stream, $offset, $whence);
    }




    /**
     * @link https://php.net/manual/en/function.popen.php
     *
     * @inheritDoc
    */
    public function rewind(): bool
    {
        return rewind($this->getStream());
    }




    /**
     * @link https://www.php.net/manual/en/function.fopen.php
     *
     * @inheritDoc
    */
    public function isWritable(): bool
    {
         $mode = $this->getMetadata('mode');

         # ['w', 'w+', 'a', 'a+', 'c', 'c+'
         foreach (['x', 'w', 'c', 'a', '+'] as $writable) {
             if(strstr($mode, $writable)) {
                  return true;
             }
         }

         return false;
    }



    /**
     * @inheritDoc
    */
    public function write($string): bool|int
    {
        return fwrite($this->getStream(), $string);
    }



    /**
     * @link https://www.php.net/manual/en/function.fopen.php
     *
     * @inheritDoc
    */
    public function isReadable(): bool
    {
        $mode = $this->getMetadata('mode');

        # ['r', 'r+', 'x', 'x+']
        foreach (['r', 'x', '+'] as $writable) {
            if(strstr($mode, $writable)) {
                return true;
            }
        }

        return false;
    }




    /**
     * @inheritDoc
    */
    public function read($length): bool|string
    {
       return fgets($this->getStream(), $length);
    }



    /**
     * @inheritDoc
    */
    public function getContents(): bool|string
    {
        return stream_get_contents($this->stream);
    }




    /**
     * @inheritDoc
    */
    public function getMetadata($key = null)
    {
        $meta = stream_get_meta_data($this->getStream());

        return $key ? $meta[$key] : $meta;
    }



    /**
     * @return resource
     */
    public function getStream()
    {
         if (! $this->stream) {
             throw new InvalidArgumentException('Invalid stream provided; must be a string stream identifier or stream resource');
         }

         return $this->stream;
    }
}