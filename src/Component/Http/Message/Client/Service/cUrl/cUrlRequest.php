<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;


/**
 * @cUrlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client\Service\cUrl
*/
class cUrlRequest
{

     /**
      * @var string|null
     */
     protected ?string $url;



     /**
      * @var string|null
     */
     protected ?string $method;



     /**
      * @var array|string
     */
     protected $body;



     /**
      * @var array
     */
     protected $queries = [];




     /**
      * @var array
     */
     protected $attributes = [];




     /**
      * @var array
     */
     protected $headers = [];




     /**
      * @var array
     */
     protected $cookies = [];




     /**
      * @var array
     */
     protected $files = [];



     /**
      * @var array
     */
     protected $options = [
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_SSL_VERIFYPEER => false,
         CURLOPT_HEADER => false
     ];



     /**
      * @var \CurlHandle|false
     */
     protected $ch;



     /**
      * @var cUrlInfo
     */
     protected $info;




     /**
      * @param string|null $url
     */
     public function __construct(string $url = null)
     {
          $this->ch   = curl_init($url);
          $this->info = new cUrlInfo($this->ch);
     }





     /**
      * @param string $url
      *
      * @param array $queries
      *
      * @return $this
     */
     public function url(string $url, array $queries = []): static
     {
          $this->url = $url;

          if ($queries) {
              $this->url .= '?'. $this->buildQuery($queries);
          }

          $this->queries = $queries;

          return $this;
     }





     /**
      * @param string $method
      *
      * @return $this
     */
     public function method(string $method): static
     {
          switch ($method):
              case 'GET':
              case 'HEAD':
                  //
                  break;
              case 'POST':
              case 'PUT':
              case 'PATCH':
              case 'DELETE':
                  $this->option(CURLOPT_CUSTOMREQUEST, $method);
                  break;
          endswitch;

          $this->method = $method;

          return $this;
     }





     /**
      * @param array|string $body
      *
      * @return $this
     */
     public function body(array|string $body): static
     {
         $this->body = $body;

         return $this;
     }





     /**
      * @param array $attributes
      *
      * @return $this
     */
     public function attributes(array $attributes): static
     {
         $this->attributes = array_merge($this->attributes, $attributes);

         return $this;
     }




     /**
      * @param array $headers
      *
      * @return $this
     */
     public function headers(array $headers): static
     {
         $this->headers = $headers;

         return $this;
     }




     /**
      * @param array $cookies
      *
      * @return $this
     */
     public function cookies(array $cookies): static
     {
          $this->cookies = $cookies;

          return $this;
     }




     /**
      * @param array $files
      *
      * @return $this
     */
     public function files(array $files): static
     {
         $this->files = $files;

         return $this;
     }




     /**
      * @param $key
      *
      * @param $value
      *
      * @return $this
     */
     public function option($key, $value): static
     {
          curl_setopt($this->ch, $key, $value);

          return $this;
     }




     /**
      * @param array $options
      *
      * @return $this
     */
     public function options(array $options): static
     {
          curl_setopt_array($this->ch, $options);

          return $this;
     }



     /**
      * @param string $method
      *
      * @param string $url
      *
      * @param array $options
      *
      * @return cUrlResponse
     */
     public function request(string $method, string $url, array $options = []): cUrlResponse
     {
          $request = new static();
          $request->method($method);
          $request->url($url, $options['query'] ?? []);

          return $request->send();
     }




     /**
      * @return cUrlResponse
     */
     public function send(): cUrlResponse
     {
         /*
         // method
         switch ($this->method):
             case 'GET':
             case 'HEAD':
                 if ($this->queries) { $this->url .= '?'. http_build_query($this->queries); }
                 break;
             case 'POST':
             case 'PUT':
             case 'PATCH':
             case 'DELETE':
                 break;
         endswitch;
         */

         #dd($this->url);

         return $this->getResponse();
     }



    /**
     * @return array
    */
    public function getOptions(): array
    {
        return $this->options;
    }




    /**
     * @return cUrlResponse
    */
    public function getResponse(): cUrlResponse
    {
        $this->option(CURLOPT_URL, $this->url);
        $this->options($this->options);
        $response = new cUrlResponse($this->exec());
        $info = $this->getInfo();
        $response->setStatusCode($info->getStatusCode());
        $this->close();

        return $response;
    }




    /**
     * @return cUrlInfo
    */
    public function getInfo(): cUrlInfo
    {
         return $this->info;
    }




    /**
     * @return bool|string
    */
    public function exec(): bool|string
    {
        return curl_exec($this->ch);
    }




    /**
     * @return void
    */
    public function close()
    {
        curl_close($this->ch);
    }


    /**
     * @param array $parameters
     *
     * @return string
    */
    private function buildQuery(array $parameters): string
    {
        return http_build_query($parameters, '', '&');
    }
}