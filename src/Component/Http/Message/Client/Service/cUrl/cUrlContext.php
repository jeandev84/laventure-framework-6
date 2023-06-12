<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

class cUrlContext implements \ArrayAccess
{

     /**
      * @var array
     */
     protected $options = [
         'query'   => [],
         'headers' => [],
         'body'    => null,
         'files'   => []
     ];




     /**
      * @param array $options
     */
     public function __construct(array $options)
     {
         $this->options = array_merge($this->options, $options);
     }




     /**
      * @return array
     */
     public function getQuery(): array
     {
         return $this->getOption('query', []);
     }



     /**
      * @return array
     */
     public function getHeaders(): array
     {
          return $this->getOption('headers', []);
     }




     /**
      * @return mixed
     */
     public function getBody(): mixed
     {
         return $this->getOption('body');
     }




     /**
      * @return array
     */
     public function getFiles(): array
     {
        return $this->getOption('files', []);
     }




     /**
      * @param string $key
      *
      * @param $default
      *
      * @return mixed|null
     */
     public function getOption(string $key, $default = null)
     {
         return $this->options[$key] ?? $default;
     }





     /**
      * @inheritDoc
     */
     public function offsetExists(mixed $offset): bool
     {
         return isset($this->options[$offset]);
    }



    /**
     * @inheritDoc
    */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->options[$offset] ?? null;
    }




    /**
     * @inheritDoc
    */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->options[$offset] = $value;
    }



    /**
     * @inheritDoc
    */
    public function offsetUnset(mixed $offset): void
    {
         unset($this->options[$offset]);
    }
}