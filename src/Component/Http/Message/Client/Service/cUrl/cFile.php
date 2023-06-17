<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

class cFile
{


    /**
     * @var string|null
    */
    protected ?string $name;


    /**
     * @var string|null
    */
    protected ?string $mime;



    /**
     * @var string|null
    */
    protected ?string $path;




    /**
     * @param array $params
    */
    public function __construct(array $params)
    {
        $this->bindParams($params);
    }




    /**
     * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }




    /**
     * @return string|null
    */
    public function getMime(): ?string
    {
        return $this->mime;
    }




    /**
     * @return false|int
    */
    public function getSize(): bool|int
    {
         return filesize($this->getPath());
    }




    /**
     * @return string|null
    */
    public function getExtension(): ?string
    {
         return pathinfo($this->getPath(), PATHINFO_EXTENSION);
    }




    /**
     * @return string|null
    */
    public function getPath(): ?string
    {
        return $this->path;
    }




    /**
     * @return array
    */
    public function toArray(): array
    {
         return get_object_vars($this);
    }





    /**
     * @param array $file
     *
     * @return void
    */
    private function bindParams(array $file): void
    {
         foreach ($file as $key => $value) {
              if (property_exists($this, $key)) {
                  $this->{$key} = $value;
              }
         }
    }
}