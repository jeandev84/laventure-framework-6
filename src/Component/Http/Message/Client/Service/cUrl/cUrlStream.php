<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

class cUrlStream
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
      * @param $resource
     */
     public function __construct($resource)
     {
         if (is_file($resource)) {
             $this->stream = fopen($resource, 'r');
             $this->size   = filesize($resource);
         }

     }





     /**
      * @return mixed
     */
     public function getStream(): mixed
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