<?php
namespace Laventure\Component\Http\Response;

class JsonResponse extends Response
{

      /**
       * @param array|object $data
       *
       * @param int $statusCode
       *
       * @param array $headers
      */
      public function __construct($data, int $statusCode = 200, array $headers = [])
      {
            $headers = array_merge(['Content-Type' => 'application/json; charset=UTF-8'], $headers);

            parent::__construct($this->encode($data), $statusCode, $headers);
      }




      /**
       * @param array|object $data
       *
       * @return false|string
      */
      private function encode(array|object $data): bool|string
      {
           $content = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);

           if (json_last_error()) {
                trigger_error(json_last_error_msg());
           }

           return $content;
      }
}