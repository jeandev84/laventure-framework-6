<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream;

use Laventure\Component\Http\Message\Stream\Stream as StreamResource;


class Stream extends StreamResource
{



     /**
      * @var string|null
     */
     protected ?string $path;



     /**
      * @var int|null
     */
     protected ?int $filesize;




     /**
      * @param string $filename
      *
      * @param string $accessMode
      *
      * @return Stream|false
     */
     public static function createFromFile(string $filename, string $accessMode = 'r'): static|false
     {
         if(! $stream = parent::createFromFile($filename, $accessMode)) {
             return false;
         }

         $stream->setPath($filename);

         return $stream;
     }




     /**
       * @param string $path
       *
       * @return void
     */
     private function setPath(string $path): void
     {
         $this->path     = $path;
         $this->filesize = filesize($path);
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
    public function hasFile(): bool
    {
        return is_file($this->path);
    }



    /**
     * @inheritdoc
    */
    public function getSize(): int
    {
        if ($this->filesize) {
            return $this->filesize;
        }

        return parent::getSize();
    }
}