<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

use Laventure\Component\Http\Message\Client\Service\Stream\Stream;

class cUrlResponse
{

      /**
       * @var string|null
      */
      protected ?string $body;



      /**
       * @var int
      */
      protected int $statusCode;



      /**
       * @var array
      */
      protected array $headers = [];




      /**
       * @param string|null $body
       *
       * @param int $statusCode
       *
       * @param array $headers
      */
      public function __construct(?string $body = null, int $statusCode = 200, array $headers = [])
      {
           $this->body = $body;
           $this->statusCode = $statusCode;
           $this->headers = $headers;
      }




      /**
       * @param Stream $stream
       *
       * @return $this
      */
      public function download(Stream $stream): static
      {
           $stream->write($this->body);

           return $this;
      }




      /**
       * @param string|null $body
       *
       * @return $this
      */
      public function setBody(?string $body): static
      {
          $this->body = $body;

          return $this;
      }





      /**
       * @param int $statusCode
       * @return cUrlResponse
      */
      public function setStatusCode(int $statusCode): static
      {
         $this->statusCode = $statusCode;

         return $this;
      }




     /**
      * @param array $headers
      *
      * @return $this
     */
     public function setHeaders(array $headers): static
     {
         $this->headers = $headers;

         return $this;
     }


      /**
       * @return string|null
      */
      public function getBody(): ?string
      {
          return $this->body;
      }




     /**
      * @return array
     */
     public function getHeaders(): array
     {
        return $this->headers;
     }




    /**
     * @return int
    */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}