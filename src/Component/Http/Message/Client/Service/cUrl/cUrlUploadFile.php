<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

class cUrlUploadFile
{

     /**
      * @var resource|false
      */
     protected $stream;


     /**
      * @var int|null
     */
     protected ?int $size;



     /**
      * @param string $path
     */
     public function __construct(string $path)
     {
         $this->stream = fopen($path, 'r');
         $this->size   = filesize($path);
     }





     /**
      * @return bool
     */
     public function getResource(): bool
     {
         return $this->stream;
     }



    /**
     * @return int|null
    */
    public function getSize(): ?int
    {
        return $this->size;
    }
}