<?php
namespace Laventure\Component\Http\Request\Body;

use Laventure\Component\Http\Message\StreamInterface;


/**
 * @RequestBody
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\Body
*/
class RequestBody implements StreamInterface
{


    /**
     * @param string $path
    */
    public function __construct(protected string $path = 'php://input')
    {
    }



    /**
     * @param string $path
     *
     * @return $this;
    */
    public function setPath(string $path): static
    {
         $this->path = $path;

         return $this;
    }




    /**
     * @inheritDoc
    */
    public function close()
    {
        // TODO: Implement close() method.
    }




    /**
     * @inheritDoc
    */
    public function detach()
    {
        // TODO: Implement detach() method.
    }



    /**
     * @inheritDoc
    */
    public function getSize()
    {
        // TODO: Implement getSize() method.
    }



    /**
     * @inheritDoc
    */
    public function tell()
    {
        // TODO: Implement tell() method.
    }



    /**
     * @inheritDoc
    */
    public function eof()
    {
        // TODO: Implement eof() method.
    }



    /**
     * @inheritDoc
    */
    public function isSeekable()
    {
        // TODO: Implement isSeekable() method.
    }



    /**
     * @inheritDoc
    */
    public function seek($offset, $whence = SEEK_SET)
    {
        // TODO: Implement seek() method.
    }



    /**
     * @inheritDoc
    */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }




    /**
     * @inheritDoc
    */
    public function isWritable()
    {
        // TODO: Implement isWritable() method.
    }



    /**
     * @inheritDoc
    */
    public function write($string)
    {
        // TODO: Implement write() method.
    }



    /**
     * @inheritDoc
     */
    public function isReadable()
    {
        // TODO: Implement isReadable() method.
    }



    /**
     * @inheritDoc
    */
    public function read($length)
    {
        // TODO: Implement read() method.
    }



    /**
     * @inheritDoc
    */
    public function getContents()
    {
        // TODO: Implement getContents() method.
    }



    /**
     * @inheritDoc
    */
    public function getMetadata($key = null)
    {
        // TODO: Implement getMetadata() method.
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }
}