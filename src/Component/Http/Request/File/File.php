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
     * @var string
     */
    protected $name;



    /**
     * @var string
     */
    protected $type;



    /**
     * @var string
    */
    protected $temp;



    /**
     * @var int
     */
    protected $error;




    /**
     * @var int
    */
    protected $size;




    /**
     * UploadedFile constructor.
     * @param string $name
     * @param string $type
     * @param string $temp
     * @param string $error
     * @param int $size
    */
    public function __construct(string $name, string $type, string $temp, string $error, int $size)
    {
        $this->name = $name;
        $this->type = $type;
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
        return $this->type;
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
}