<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;


use Laventure\Component\Http\Message\Request\File\UploadedFile;

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
      * @var mixed
     */
     protected $body;



     /**
      * @var
     */
     protected $uploadedFile;



     /**
      * @var array
     */
     protected $data = [];



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
         $this->ch = curl_init($url);
         $this->options([
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_SSL_VERIFYPEER => false,
             CURLOPT_HEADER => false
         ]);

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

          $this->proxy($url);

          $this->option(CURLOPT_URL, $this->url);

          return $this;
     }




     /**
      * @param string $proxy
      *
      * @return $this
     */
     public function proxy(string $proxy): static
     {
          if (stripos($proxy, ':') === false) {
              return $this;
          }

          return $this->options([
              CURLOPT_TIMEOUT => 400,
              CURLOPT_PROXY   => $proxy
          ]);
     }




     /**
      * @param string $login
      *
      * @param string $password
      *
      * @return $this
     */
     public function auth(array $credentials): static
     {
          if (empty($credentials['login'])) {
              return $this;
          }

          if (empty($credentials['password'])) {
              return $this;
          }

          $credentials = join(":", array_values($credentials));

          return $this->option(CURLOPT_USERPWD, $credentials);
     }





     /**
      * @param string $name
      * @param array $headers
      *
      * @param string|null $cookieFilename
      *
      * @return $this
    */
    public function userAgent(string $name, array $headers = [], string $cookieFilename = null): static
    {
        $this->option(CURLOPT_USERAGENT, $name);

        $headers = array_merge($this->browserHeaders, $headers);
        $this->headers(array_merge($this->browserHeaders, $headers));
        $this->cookieJar($cookieFilename ?: __DIR__.'/data/cookie.txt');

        return $this->returnHeader(true);
    }




     /**
      * @param string $method
      *
      * @return $this
     */
     public function method(string $method): static
     {
          switch ($method):
              case 'POST':
                  $this->option(CURLOPT_POST, 1);
              break;
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
      * @param mixed $body
      *
      * @return $this
     */
     public function body(mixed $body): static
     {
         if (is_array($body)) {
             return $this->data($body);
         }

         $this->body = $body;

         return $this;
     }




     /**
      * @param array $data
      *
      * @return $this
     */
     public function data(array $data): static
     {
          $this->data =  $data;

          return $this;
     }





     /**
      * @param array $data
      *
      * @return $this
     */
     public function json(array $data): static
     {
        $this->options([
            CURLOPT_HTTPHEADER => ['Content-Type: application/json']
        ]);

        $this->body(json_encode($data, JSON_UNESCAPED_UNICODE));

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

         return $this->option(CURLOPT_HTTPHEADER, $this->headers);
     }





     /**
      * @param array $cookies
      *
      * @return $this
     */
     public function cookies(array $cookies): static
     {
          $this->option(CURLOPT_COOKIE, $this->buildQuery($cookies));

          $this->cookies = $cookies;

          return $this;
     }




     /**
      * @param string $path
      *
      * @return $this
     */
     public function cookieJar(string $path): static
     {
          return $this->options([
              CURLOPT_COOKIEFILE => $path,
              CURLOPT_COOKIEJAR  => $path
          ]);
     }




     /**
      * @param array $files
      *
      * @return $this
     */
     public function files(array $files): static
     {
         foreach ($files as $key => $params) {
            $this->files[$key] = $this->createFileFromArray($params);
         }

         return $this;
     }




     /**
      * @return $this
     */
     public function upload($path): static
     {
         if (! $path) { return $this; }

         $file = new cUrlStream($path);

         return $this->options([
             CURLOPT_UPLOAD     => true,
             CURLOPT_INFILESIZE => $file->getSize(),
             CURLOPT_INFILE     => $file->getStream()
         ]);
     }




     /**
      * @param $stream
      * @return $this
     */
     public function download($stream)
     {

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
          $context = new cUrlContext($context);
          $request = new static();
          $request->method($method);
          $request->url($url, $context->getQuery());
          $request->proxy($context->getProxy());
          $request->auth($context->getAuth());
          $request->headers($context->getHeaders());
          $request->body($context->getBody());
          $request->files($context->getFiles());
          $request->cookies($context->getCookies());
          $request->upload($context->getUploadedFile());


          return $request->send();
     }


    /**


     /**
      * @return cUrlResponse
     */
     public function send(): cUrlResponse
     {
         return $this->getResponse();
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
     * @return mixed
     */
    public function getBody(): mixed
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
     * @return array
    */
    public function getData(): array
    {
        return $this->data;
    }




    /**
     * @return array
    */
    public function getPostFields(): array
    {
         return array_merge($this->data, $this->files);
    }





    /**
     * @param array $params
     *
     * @return \CURLFile
    */
    private function createFileFromArray(array $params): \CURLFile
    {
        $file = new cUrlFileBag($params);
        return curl_file_create($file->getPath(), $file->getMime(), $file->getName());
    }




    /**
     * @return bool|string
    */
    private function exec(): bool|string
    {
        return curl_exec($this->ch);
    }




    /**
     * @return void
    */
    private function close()
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

         return $resolved;
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
     * @return cUrlResponse
    */
    private function getResponse(): cUrlResponse
    {
        $this->prepareOptions();

        $body = $this->exec();

        if ($errno = curl_errno($this->ch)) {
            return (function () use ($errno) {
                throw new cUrlException(curl_error($this->ch), $errno);
            })();
        }

        $response = new cUrlResponse($body);
        $response->setStatusCode($this->getStatusCode());
        $response->setHeaders($this->getResponseHeaders());
        $this->close();

        return $response;
    }




    /**
     * @param bool $return
     *
     * @return $this
     */
    private function returnHeader(bool $return): static
    {
        return $this->option(CURLOPT_HEADER, $return);
    }


    /**
     * @return void
    */
    private function prepareOptions(): void
    {
        switch ($this->method):
            case 'GET':
            case 'HEAD':
                $this->option(CURLOPT_HEADER, false);
                break;
            case 'POST':
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                $this->option(CURLOPT_POSTFIELDS, $this->getPostFields());
                break;
        endswitch;
    }
}