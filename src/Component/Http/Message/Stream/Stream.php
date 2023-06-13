<?php
namespace Laventure\Component\Http\Message\Stream;

use InvalidArgumentException;
use Laventure\Component\Http\Message\StreamInterface;

/**
 * @Stream
 *
 * @link https://www.php.net/manual/fr/class.streamwrapper.php
 * @link https://www.php.net/manual/ru/wrappers.php.php
 *
 * @link https://www.php.net/manual/fr/ref.stream.php
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
 * @package Laventure\Component\Message\Http\Stream
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
     * @param $resource
     *
     * @param string|null $accessMode
     *
     * @param bool $includePath
     *
     * @param null $context
     */
    public function __construct($resource, string $accessMode = null, bool $includePath = false, $context = null)
    {
        if (is_string($resource)) {
            $resource = fopen($resource, $accessMode, $includePath, $context);
        }

        $this->setStream($resource);
    }



    /**
     * @param string|resource $stream
    */
    public function setStream(mixed $stream): void
    {
        if (! $this->isResource($stream)) {
            throw new InvalidArgumentException('Invalid stream provided.');
        }

        $this->stream = $stream;
    }



    /**
     * @param $stream
     *
     * @return bool
    */
    public function isResource($stream): bool
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
    public function seek($offset = 0, $whence = SEEK_SET): int
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
        return $string ? fwrite($this->stream, $string) : false;
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
     * @return mixed
    */
    public function getResource(): mixed
    {
        if (! $this->stream) {
            (function () {
               throw new StreamException("empty stream.");
            })();
        }

        return $this->stream;
    }


    /**
     * @param $resource
     *
     * @param string|null $accessMode
     *
     * @return Stream
    */
    public static function create($resource, string $accessMode = null): Stream
    {
        return new static($resource, $accessMode);
    }






    /**
     * @param string $filename
     *
     * @param string $accessMode
     *
     * @return $this|false
    */
    public static function createFromFile(string $filename, string $accessMode = 'r'): static|false
    {
        if (! is_file($filename)) {
            return false;
        }

        return new static($filename, $accessMode);
    }


    /**
     * @param $resource
     *
     * @param string $accessMode
     *
     * @param $context
     *
     * @return static
   */
    public static function createFromContext($resource, string $accessMode, $context): static
    {
         return new static($resource, $accessMode, false, $context);
    }





    /**
     * @param $resource
     *
     * @param string $accessMode
     *
     * @return static
    */
    public static function createWithIncludePath($resource, string $accessMode): static
    {
        return new static($resource, $accessMode, true);
    }




    /**
     * @param string $accessMode
     *
     * @return Stream
    */
    public static function createTempFile(string $accessMode = 'w'): Stream
    {
        return new static('php://temp', $accessMode);
    }
}