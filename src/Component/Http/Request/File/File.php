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
      * @param string $name
      * @param string $type
      * @param int $size
      * @param int $error
    */
    public function __construct(protected string $name, protected string $type, protected int $size, protected int $error)
    {
    }


    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }



    /**
     * @return string
    */
    public function getType(): string
    {
        return $this->type;
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