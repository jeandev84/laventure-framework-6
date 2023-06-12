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
     * @var \CurlHandle|false
    */
    protected $ch;



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
     protected $headers = [];




     /**
      * @var string[]
     */
     protected $browserHeaders = [
         'cache-control: max-age=0',
         'upgrade-insecure-requests: 1',
         'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
         'sec-fetch-user: ?1',
         'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
         'x-compress: null',
         'sec-fetch-site: none',
         'sec-fetch-mode: navigate',
         'accept-encoding: deflate, br',
         'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7'
     ];



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
     protected $options = [];




     /**
      * @param string|null $url
     */
     public function __construct(string $url = null)
     {
          $this->init($url);
     }




     /**
      * @param string|null $url
      * @return $this
     */
     public function init(string $url = null): static
     {
         $this->ch   = curl_init($url);

         $this->options([
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_SSL_VERIFYPEER => false,
             CURLOPT_HEADER => false
         ]);

         return $this;
     }



     /**
      * Set user agent
      *
      * @param string $agent
      *
      * @return $this
     */
     public function userAgent(string $agent): static
     {
         $this->option(CURLOPT_USERAGENT, $agent);

         return $this;
     }




     /**
      * @param bool $return
      *
      * @return $this
     */
     public function returnTransfer(bool $return): static
     {
          return $this->option(CURLOPT_RETURNTRANSFER, $return);
     }




     /**
      * @param array $headers
      * @return $this
     */
     public function browserHeaders(array $headers): static
     {
         $this->browserHeaders = $headers;

         return $this;
     }




     /**
      * @return $this
     */
     public function withoutBrowserHeaders(): static
     {
          $this->browserHeaders = [];

          return $this;
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
          $this->url     = $url;
          $this->queries = $queries;

          if ($queries) {
              $this->url .= '?'. $this->buildQuery($queries);
          }

          $this->option(CURLOPT_URL, $this->url);

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
         if (is_array($body)) {
            $body = array_merge((array)$this->getBody(), $body);
            $this->option(CURLOPT_POSTFIELDS, $this->buildQuery($body));
         }

         $this->body = $body;

         return $this;
     }




     /**
      * @param array $headers
      *
      * @return $this
     */
     public function headers(array $headers): static
     {
         $headers = $this->resolveHeaders($headers);

         $this->headers = array_merge($this->headers, $headers);

         return $this->options([
             CURLOPT_HTTPHEADER => $this->headers,
             CURLOPT_HEADER     => true
         ]);
     }




     /**
      * @param bool $return
      *
      * @return $this
     */
     public function returnHeader(bool $return): static
     {
         return $this->option(CURLOPT_HEADER, $return);
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

          $this->options[$key] = $value;

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

          $this->options = array_merge($this->options, $options);

          return $this;
     }




     /**
      * @param string $method
      *
      * @param string $url
      *
      * @param array $context
      *
      * @return cUrlResponse
     */
     public function request(string $method, string $url, array $context = []): cUrlResponse
     {
          $request = new static();
          $request->method($method);
          $request->url($url, $context['query'] ?? []);
          $request->headers($context['headers'] ?? []);
          $request->body($context['body'] ?? '');

          return $request->send();
     }




     /**
      * @return cUrlResponse
     */
     public function send(): cUrlResponse
     {
         return $this->getResponse();
     }





    /**
     * @return cUrlResponse
    */
    public function getResponse(): cUrlResponse
    {
        if (in_array($this->method, ['GET', 'HEAD'])) {
            $this->option(CURLOPT_HEADER, false);
        }

        $response = new cUrlResponse($this->exec());
        $response->setStatusCode($this->getStatusCode());
        $response->setHeaders($this->getResponseHeaders());
        $this->close();

        return $response;
    }




    /**
     * @return mixed
    */
    public function getInfos(): mixed
    {
         return curl_getinfo($this->ch);
    }




    /**
     * @param $key
     *
     * @return mixed
    */
    public function getInfo($key)
    {
         return curl_getinfo($this->ch, $key);
    }





    /**
     * @return mixed
    */
    public function getHeaderSize()
    {
        return $this->getInfo(CURLINFO_HEADER_SIZE);
    }



    /**
     * @return int
    */
    public function getStatusCode(): int
    {
        return (int) $this->getInfo(CURLINFO_HTTP_CODE);
    }




    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }





    /**
     * @return array|string
     */
    public function getBody(): array|string
    {
        return $this->body;
    }




    /**
     * @return array
    */
    public function getCookies(): array
    {
        return $this->cookies;
    }



    /**
     * @return array
    */
    public function getFiles(): array
    {
        return $this->files;
    }




    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }



    /**
     * @return array
    */
    public function getQueries(): array
    {
        return $this->queries;
    }




    /**
     * @return string|null
    */
    public function getUrl(): ?string
    {
        return $this->url;
    }



    /**
     * @return array
    */
    public function getOptions(): array
    {
        return $this->options;
    }




    /**
     * @return \CurlHandle|false
    */
    public function getHandle(): \CurlHandle|bool
    {
        return $this->ch;
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




    /**
     * @param array $headers
     *
     * @return array
    */
    private function resolveHeaders(array $headers): array
    {
         $resolved = [];

         foreach ($headers as $key => $value) {
             $resolved[] = (is_string($key) ? "$key: $value" : $value);
         }

         return array_merge($this->browserHeaders, $resolved);
    }




    /**
     * @param $response
     *
     * @return string
    */
    private function getResponseWithoutHeaders($response): string
    {
        if (! is_string($response)) {
            return "";
        }

        return substr($response, $this->getHeaderSize());
    }




    /**
     * @return array
    */
    private function getResponseHeaders(): array
    {
         $this->options([CURLOPT_HEADER => true, CURLOPT_NOBODY => true]);

         $response = $this->exec();

         $headersRows = explode(PHP_EOL, $response);
         $headersRows = array_filter($headersRows, 'trim');

         $headers = [];

         foreach ($headersRows as $headersRow) {
              $position = stripos($headersRow, ':');
              if ($position !== false) {
                  list($key, $value) = explode(':', $headersRow);
                  $headers[$key] = trim($value);
              }
         }

         return $headers;
    }




    /**
     * @return void
    */
    public function __destruct()
    {
         $this->close();
    }
}