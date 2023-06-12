<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;

class cUrlInfo
{

     /**
      * @param \CurlHandle|false $ch
     */
     public function __construct(protected \CurlHandle|false $ch)
     {
     }




     /**
      * @return mixed
     */
     public function all(): mixed
     {
          return curl_getinfo($this->ch);
     }




     /**
      * @param $key
      *
      * @return mixed
     */
     public function get($key): mixed
     {
         return curl_getinfo($this->ch, $key);
     }



     /**
      * @return int
     */
     public function getStatusCode(): int
     {
         return (int) $this->get(CURLINFO_HTTP_CODE);
     }
}