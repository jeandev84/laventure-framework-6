<?php
namespace Laventure\Component\Http\Request\File;

use Laventure\Component\Http\Request\Contract\UploadedFileInterface;

/**
 * @UploadedFile
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\File
*/
class UploadedFile extends File implements UploadedFileInterface
{


    /**
     * @param string $name
     *
     * @param string $type
     *
     * @param int $size
     *
     * @param int $error
    */
    public function __construct(string $name, string $type, int $size, int $error)
    {
        parent::__construct($name, $type, $size, $error);
    }



    /**
     * @inheritDoc
    */
    public function moveTo($targetPath)
    {
        // TODO: Implement moveTo() method.
    }



    public function move()
    {

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
    public function getError()
    {
        // TODO: Implement getError() method.
    }

    /**
     * @inheritDoc
    */
    public function getClientFilename()
    {
        // TODO: Implement getClientFilename() method.
    }




    /**
     * @inheritDoc
     */
    public function getClientMediaType()
    {
        // TODO: Implement getClientMediaType() method.
    }



    /**
     * @inheritDoc
    */
    public function getStream()
    {
        // TODO: Implement getStream() method.
    }
}