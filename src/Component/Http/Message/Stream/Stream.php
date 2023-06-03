<?php
namespace Laventure\Component\Http\Message\Stream;

use InvalidArgumentException;
use Laventure\Component\Http\Message\StreamInterface;

/**
 * @Stream
 *
 * @link https://www.php.net/manual/fr/ref.stream.php
 * @link https://www.php.net/manual/fr/class.streamwrapper.php
 * @link https://www.php.net/manual/fr/function.stream-context-create.php
 * @link https://www.php.net/manual/en/function.stream-get-contents.php
 * @link https://www.php.net/manual/en/function.stream-get-meta-data.php
 * @link https://www.php.net/manual/en/function.is-writable.php
 * @link https://www.php.net/manual/en/function.fopen.php
 * @link https://www.php.net/manual/en/function.is-readable.php
 * @link https://www.php.net/manual/en/function.stream-filter-remove.php
 * @link https://www.php.net/manual/ru/function.fseek.php
 * @link https://www.php.net/manual/ru/function.ftell.php
 * @link https://www.php.net/manual/ru/function.filesize.php
 * @link https://www.php.net/manual/fr/function.fstat.php
 * @link https://www.php.net/manual/ru/function.feof.php
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
     * @var string
    */
    protected $length;


    /**
     * @var int
    */
    protected $offset = -1;



    /**
     * @param string $stream
     *
     * @param string $accessMode
    */
    public function __construct($stream, string $accessMode)
    {
          $this->stream = $this->make($stream, $accessMode);
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
      * @param string $length
      *
      * @return $this
     */
     public function length(string $length): static
     {
         $this->length = $length;

         return $this;
     }



     /**
      * @param int $offset
      *
      * @return $this
     */
     public function offset(int $offset): static
     {
          $this->offset = $offset;

          return $this;
     }





    /**
     * @inheritDoc
    */
    public function __toString()
    {
         if (! $this->isReadable()) {
              return '';
         }

        return stream_get_contents($this->stream, $this->length, $this->offset);
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
        return feof($this->stream);
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
        return rewind($this->stream);
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
        return fwrite($this->stream, $string);
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
       return fgets($this->stream, $length);
    }




    /**
     * @param $length
     *
     * @param $offset
     *
     * @return false|string
    */
    public function readStream($length, $offset): bool|string
    {
        return stream_get_contents($this->stream, $length, $offset);
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
        $meta = stream_get_meta_data($this->stream);

        return $key ? $meta[$key] : $meta;
    }




    /**
     * @param $stream
     *
     * @param $accessMode
     *
     * @return false|mixed|resource
    */
    private function make($stream, $accessMode)
    {
        if (is_string($stream)) {
            $stream = fopen($stream, $accessMode);
        }

        if (! $this->isStream($stream)) {
            throw new InvalidArgumentException('Invalid stream provided; must be a string stream identifier or stream resource');
        }

        return $stream;
    }
}