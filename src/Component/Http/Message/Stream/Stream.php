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
     * @var string|null
    */
    protected ?string $path;





    /**
     * @var string|null
    */
    protected ?string $accessMode;



    /**
     * @var bool|null
    */
    protected ?bool $includePath = false;



    /**
     * @var resource|null
    */
    protected $context;





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
        $this->open($resource, $accessMode, $includePath, $context);
    }





    /**
     * @param $resource
     *
     * @param string|null $accessMode
     *
     * @param bool $includePath
     *
     * @param null $context
     *
     * @return $this
    */
    public function open($resource, string $accessMode = null, bool $includePath = false, $context = null): static
    {
          if (is_string($resource)) {
              $this->setPath($resource);
              $this->setAccessMode($accessMode);
              $this->setIncludePath($includePath);
              $this->setContext($context);
              $resource = fopen($resource, $accessMode, $includePath, $context);
          }

          $this->setResource($resource);

          return $this;
    }




    /**
     * @param resource $stream
     *
     * @return $this
    */
    public function setResource($stream): static
    {
        if (! $this->valid($stream)) {
            throw new InvalidArgumentException('Invalid stream provided. must be string or resource stream type provided.');
        }

        $this->stream = $stream;

        return $this;
    }






    /**
     * @param string|null $path
     *
     * @return $this
    */
    public function setPath(?string $path): static
    {
        $this->path = $path;

        return $this;
    }




    /**
     * @param string|null $accessMode
     *
     * @return $this
    */
    public function setAccessMode(?string $accessMode): static
    {
        $this->accessMode = $accessMode;

        return $this;
    }




    /**
     * @param bool|null $includePath
     *
     * @return $this
    */
    public function setIncludePath(?bool $includePath): static
    {
        $this->includePath = $includePath;

        return $this;
    }




    /**
     * @param resource|null $context
     *
     * @return $this
    */
    public function setContext($context): static
    {
        $this->context = $context;

        return $this;
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
     * @return string|null
     */
    public function getAccessMode(): ?string
    {
        return $this->accessMode;
    }


    /**
     * @return resource|null
     */
    public function getContext()
    {
        return $this->context;
    }


    /**
     * @return bool|null
     */
    public function getIncludePath(): ?bool
    {
        return $this->includePath;
    }




    /**
     * @return string
    */
    public function getLength(): string
    {
        return $this->length;
    }




    /**
     * @inheritDoc
    */
    public function getSize(): int
    {
        if (is_file($this->path)) {
            return filesize($this->path);
        }

        return fstat($this->stream)['size'];
    }



    /**
     * @return string|null
    */
    public function getPath(): ?string
    {
        return $this->path;
    }





    /**
     * @return bool
    */
    public function isFromFile(): bool
    {
        return is_file($this->path);
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
     * @inheritDoc
    */
    public function getContents(): bool|string
    {
        return stream_get_contents($this->stream, $this->length, $this->offset);
    }




    /**
     * @param string $filename
     *
     * @return false|string
    */
    public function getContent(string $filename): bool|string
    {
         return file_get_contents($filename, false, $this->context);
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
     * @return resource
    */
    public function getResource(): mixed
    {
        return $this->stream;
    }





    /**
     * @return array
    */
    public function getOptions(): array
    {
         return stream_context_get_options($this->getResource());
    }






    /**
     * @param array $options
     *
     * @return resource
    */
    public function getDefault(array $options = [])
    {
         return stream_context_get_default($options);
    }




    /**
     * @param array $params
     *
     * @return $this
    */
    public function setParams(array $params): static
    {
        stream_context_set_params($this->getResource(), $params);

        return $this;
    }



    /**
     * @return array
    */
    public function getParams(): array
    {
        return stream_context_get_params($this->getResource());
    }





    /**
     * @return array
    */
    public function getFilters(): array
    {
         return stream_get_filters();
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
     * @param string $accessMode
     *
     * @return Stream
    */
    public static function createTempFile(string $accessMode = 'w'): Stream
    {
        return new static('php://temp', $accessMode);
    }





    /**
     * @param string $path
     *
     * @param string $accessMode
     *
     * @param array $options
     *
     * @return $this
    */
    public static function createFromContext(string $path, string $accessMode = 'r', array $options = []): static
    {
         return new static($path, $accessMode, false, static::createContext($options));
    }






    /**
     * @param array $options
     *
     * @return resource
    */
    public static function createContext(array $options = [])
    {
        return stream_context_create($options);
    }





    /**
     * @param $stream
     *
     * @return bool
    */
    private function valid($stream): bool
    {
        return is_resource($stream) && (get_resource_type($stream) === 'stream');
    }
}