<?php
namespace Laventure\Component\Http\Message\Client\Service\cUrl;


use Laventure\Component\Http\Message\Client\ClientRequest;
use Laventure\Component\Http\Message\Client\ClientResponseInterface;
use Laventure\Component\Http\Message\Client\Service\Stream\Stream;



/**
 * @cUrlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client\Service\cUrl
*/
class cUrlRequest extends ClientRequest implements cUrlRequestInterface
{


    /**
     * @var \CurlHandle|false
    */
    protected $ch;



     /**
      * @var mixed
     */
     protected $body;



     /**
      * @var Stream
     */
     protected $uploadedFile;




     /**
      * @var Stream
     */
     protected $downloadFile;




     /**
      * @var string[]
     */
     protected $allowedMethods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];



     /**
      * @var array
     */
     protected $data = [];



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
         $this->setOptions([
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
          parent::url($url, $queries);

          $this->proxy($url);

          $this->setOption(CURLOPT_URL, $this->url);

          return $this;
     }




     /**
      * @param string $proxy
      *
      * @return $this
     */
     public function proxy(string $proxy): static
     {
          if (! $this->isProxy($proxy)) {
              return $this;
          }

          return $this->setOptions([
              CURLOPT_TIMEOUT => 400,
              CURLOPT_PROXY   => $proxy
          ]);
     }




     /**
      * @param array $credentials
      * @return $this
     */
     public function auth(array $credentials): static
     {
          if (empty($credentials['login']) || $credentials['password']) {
              return $this;
          }

          $credentials = join(":", array_values($credentials));

          return $this->setOption(CURLOPT_USERPWD, $credentials);
     }





     /**
      * @param string $token
      * @return $this
     */
     public function oAuth(string $token): static
     {
          return $this->headers([
              "Authorization: $token"
          ]);
     }




    /**
     * @param array $parameters
     *
     * @return $this
    */
    public function userAgent(array $parameters): static
    {
        if (empty($parameters['name'])) {
            return $this;
        }

        $this->setOptions([
            CURLOPT_USERAGENT => $parameters['name'],
            CURLOPT_HEADER    => true
        ]);

        $headers = array_merge($this->browserHeaders, $parameters['headers'] ?? []);

        $this->headers($headers);

        return $this->cookieJar($parameters['cookieFile'] ?? __DIR__.'/data/cookie.txt');
    }




     /**
      * @param string $method
      *
      * @return $this
     */
     public function method(string $method): static
     {
         return parent::method($this->resolveMethod($method));
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
          foreach ($data as $key => $value) {
               if (is_array($value)) {
                   $data[$key] = $this->encodingJson($value);
               }
          }

          $this->data =  $data;

          return $this;
     }




     /**
      * @param string|array $data
      *
      * @return $this
     */
     public function json(string|array $data): static
     {
         $this->headers(['Content-Type' => 'application/json; charset=UTF-8']);

         if (is_array($data)) {
             $data = $this->encodingJson($data);
         }

         return $this->body($data);
     }





     /**
      * @param string $data
      *
      * @return $this
     */
     public function xml(string $data): static
     {
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

         return $this->setOption(CURLOPT_HTTPHEADER, $this->headers);
     }





     /**
      * @param array $cookies
      *
      * @return $this
     */
     public function cookies(array $cookies): static
     {
          $this->setOption(CURLOPT_COOKIE, $this->buildQueryParams($cookies));

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
          return $this->setOptions([
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
      * @param string $path
      *
      * @return $this
     */
     public function upload(string $path): static
     {
         if ($uploadedFile = Stream::createFromFile($path)) {
             $this->uploadedFile = $uploadedFile;
         }

         return $this;
     }





     /**
      * @param string $path
      *
      * @return $this
     */
     public function download(string $path): static
     {
          if ($downloadFile = Stream::createFromFile($path, 'w')) {
              $this->downloadFile = $downloadFile;
          }

          return $this;
     }





     /**
      * @param $key
      *
      * @param $value
      *
      * @return $this
     */
     public function setOption($key, $value): static
     {
          curl_setopt($this->ch, $key, $value);

          return parent::setOption($key, $value);
     }




     /**
      * @param array $options
      *
      * @return $this
     */
     public function setOptions(array $options): static
     {
          curl_setopt_array($this->ch, $options);

          return parent::setOptions($options);
     }





     /**
      * @inheritdoc
     */
     public function request(string $method, string $url, array $context = []): ClientResponseInterface
     {
          $context = new cUrlContext($context);
          $request = new static();
          $request->method($method);
          $request->url($url, $context->getQueries());
          $request->proxy($context->getProxy());
          $request->auth($context->getAuth());
          $request->oAuth($context->getAccessToken());
          $request->headers($context->getHeaders());
          $request->body($context->getBody());
          $request->files($context->getFiles());
          $request->cookies($context->getCookies());
          $request->upload($context->getUploadedFile());
          $request->download($context->getDownloadedFile());
          return $request->send();
     }





     /**
      * @inheritdoc
     */
     public function send(): ClientResponseInterface
     {
         $this->terminateOptions();

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
         $response->downloadBody($this->downloadFile);
         return $response;
     }





     /**
      * @return bool|string
     */
     public function exec(): bool|string
     {
        return curl_exec($this->ch);
     }




    /**
     * @inheritDoc
    */
    public function error()
    {
        // TODO: Implement error() method.
    }





    /**
     * @return void
     */
    public function close(): void
    {
        curl_close($this->ch);
    }




    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return 'curl';
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
    public function getAllHeaders(): array
    {
        return $this->headers;
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
     * @return array
    */
    public function getData(): array
    {
        return $this->data;
    }




    /**
     * @return mixed
    */
    public function getBody(): mixed
    {
         if (is_string($this->body)) {
             return $this->body;
         }

         return array_merge($this->data, $this->files);
    }




    /**
     * @return Stream
    */
    public function getUploadedFile(): Stream
    {
        return $this->uploadedFile;
    }





    /**
     * @return Stream
    */
    public function getDownloadFile(): Stream
    {
        return $this->downloadFile;
    }




    /**
     * @param array $params
     *
     * @return \CURLFile
    */
    private function createFileFromArray(array $params): \CURLFile
    {
        $file = new cFile($params);

        return curl_file_create($file->getPath(), $file->getMime(), $file->getName());
    }





    /**
     * @return array
    */
    public function getResponseHeaders(): array
    {
         $this->setOptions([CURLOPT_HEADER => true, CURLOPT_NOBODY => true]);

         $response = $this->exec();

         $headersRows = explode(PHP_EOL, $response);
         $headersRows = array_filter($headersRows, 'trim');

         return $this->filterHeaders($headersRows);
    }





    /**
     * @return void
    */
    private function terminateOptions(): void
    {
        if (in_array($this->method, ['GET', 'HEAD'])) {
            $this->setOption(CURLOPT_HEADER, false);
        } elseif (in_array($this->method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            if ($this->method === 'PUT' && $this->uploadedFile) {
                $this->setUploadedFileOptionsMethodPUT();
            } else {
                $this->setOption(CURLOPT_POSTFIELDS, $this->getBody());
            }
        }
    }




    /**
     * @param array $data
     *
     * @return string|bool
    */
    private function encodingJson(array $data): string|bool
    {
        return (string)json_encode($data, JSON_UNESCAPED_UNICODE);
    }




    /**
     * @return string
     */
    private function getAllowedMethodsAsString(): string
    {
        return join(',', $this->allowedMethods);
    }



    /**
     * @param string $method
     *
     * @return bool
    */
    private function isAllowedMethod(string $method): bool
    {
        return in_array($method, $this->allowedMethods);
    }




    /**
     * @param string $method
     *
     * @return string
    */
    private function resolveMethod(string $method): string
    {
        if (! $this->isAllowedMethod($method)) {
            $this->callNotAllowedMethodException($method);
        }

        switch ($method):
            case 'POST':
                $this->setOption(CURLOPT_POST, 1);
                break;
            case 'PUT':
            case 'PATCH':
            case 'DELETE':
                $this->setOption(CURLOPT_CUSTOMREQUEST, $method);
                break;
        endswitch;

        return $method;
    }





    /**
     * @param string $method
     *
     * @return void
    */
    private function callNotAllowedMethodException(string $method): void
    {
          (function () use ($method) {
              $allowedMethods = $this->getAllowedMethodsAsString();
              throw new cUrlException("Method $method is not in allowed methods [$allowedMethods]");
          })();
    }





    /**
     * @return void
    */
    private function setUploadedFileOptionsMethodPUT(): void
    {
        $this->setOptions([
            CURLOPT_PUT => 1,
            CURLOPT_UPLOAD => 1,
            CURLOPT_INFILESIZE => $this->uploadedFile->getSize(),
            CURLOPT_INFILE     => $this->uploadedFile->getResource()
        ]);
    }

}