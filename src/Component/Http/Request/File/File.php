<?php
namespace Laventure\Component\Http\Request\File;


/**
 * @File
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\File
*/
class File
{


    /**
     * File name
     *
     * @var string
    */
    protected $name;



    /**
     * File path
     *
     * @var string
    */
    protected $path;



    /**
     * File mime type
     *
     * @var string
    */
    protected $mime;



    /**
     * Temp path
     *
     * @var string
    */
    protected $temp;




    /**
     * File error
     *
     * @var int
    */
    protected $error;




    /**
     * File size
     *
     * @var int
    */
    protected $size;




    /**
     * File constructor.
     *
     * @param string $name
     *
     * @param string $path
     *
     * @param string $type
     *
     * @param string $temp
     *
     * @param int $error
     *
     * @param int $size
    */
    public function __construct(string $name, string $path, string $type, string $temp, int $error, int $size)
    {
        $this->name = $name;
        $this->path = $path;
        $this->mime = $type;
        $this->temp = $temp;
        $this->error = $error;
        $this->size = $size;
    }




    /**
     * @return string
    */
    public function getOriginalName(): string
    {
        return $this->name;
    }



    /**
     * @return string
    */
    public function getMimeType(): string
    {
        return $this->mime;
    }




    /**
     * @return string
    */
    public function getTempFile(): string
    {
        return $this->temp;
    }




    /**
     * @return int
    */
    public function getSize(): int
    {
        return $this->size;
    }




    /**
     * @return int
    */
    public function getError(): int
    {
        return $this->error;
    }



    /**
     * @return string
    */
    public function getExtension(): string
    {
        return pathinfo($this->name)['extension'] ?? '';
    }
}