<?php
namespace Laventure\Component\Http\Message\Request\Bag;

use Laventure\Component\Http\Bag\ParameterBag;

class ServerBag extends ParameterBag
{


     /**
      * Returns server name
      *
      * @return mixed|null
     */
     public function getName(): mixed
     {
          return $this->get('SERVER_NAME');
     }


     /**
      * Returns script name where your php indexed
      * For example : /index.php
      *
      * @return mixed|null
     */
     public function getScriptName()
     {
          return $this->get("SCRIPT_NAME");
     }




     /**
      * @return mixed|null
     */
     public function getScriptFilename(): mixed
     {
          return $this->get("SCRIPT_FILENAME");
     }



     /**
      * Returns current script name
      *
      * @return mixed|null
     */
     public function getPHPSelf(): mixed
     {
          return $this->get("PHP_SELF");
     }





     /**
      * Returns server port
      *
      * @return mixed|null
     */
     public function getPort(): mixed
     {
          return $this->get('SERVER_PORT');
     }





     /**
      * Returns remote address
      *
      * @return mixed|null
     */
     public function getRemoteAddress(): mixed
     {
          return $this->get('REMOTE_ADDR');
     }




     /**
      * Return remote port
      *
      * @return mixed|null
     */
     public function getRemotePort(): mixed
     {
         return $this->get('REMOTE_PORT');
     }





     /**
      * @return string
     */
     public function getRequestMethod(): string
     {
          return $this->toUpper('REQUEST_METHOD', 'GET');
     }




     /**
      * Returns request uri
      *
      * @return string
     */
     public function getRequestUri(): string
     {
          return $this->get('REQUEST_URI', '/');
     }




     /**
      * Return request time as integer
      *
      * @return int|null
     */
     public function getRequestTime(): ?int
     {
          return $this->get("REQUEST_TIME");
     }




     /**
      * Returns request time as float
      *
      * @return mixed|null
     */
     public function getRequestTimeAsFloat(): mixed
     {
         return $this->get("REQUEST_TIME_FLOAT");
     }



     /**
      * Returns document root
      *
      * @return mixed|null
     */
     public function getDocumentRoot(): mixed
     {
          return $this->get('DOCUMENT_ROOT');
     }





     /**
      * Returns version protocol
      *
      * @return mixed|null
     */
     public function getProtocolVersion(): mixed
     {
         return $this->get('SERVER_PROTOCOL');
     }





     /**
      * Return request path info
      *
      * @return string
     */
     public function getPathInfo(): string
     {
         if (! $this->has('PATH_INFO')) {
             return strtok($this->getRequestUri(), '?');
         }

         return $this->get('PATH_INFO', '');
     }





     /**
      * Return request query string
      *
      * @return mixed|null
     */
     public function getQueryString(): mixed
     {
         return $this->get('REQUEST_QUERY');
     }






     /**
      * Returns Host name
      *
      * @return string
     */
     public function getHost(): string
     {
          return $this->get('HTTP_HOST', '');
     }





     /**
      * @return mixed|null
     */
     public function getReferer(): mixed
     {
          return $this->get('HTTP_REFERER');
     }





     /**
      * @return array
     */
     public function getHeaders(): array
     {
         $headers = [];

         foreach ($this->all() as $key => $value) {
             if(stripos($key, 'HTTP_') === 0) {
                $headers[substr($key, 5)] = $value;
             } elseif (\in_array($key, ['CONTENT_TYPE', 'CONTENT_LENGTH', 'CONTENT_MD5'], true)) {
                $headers[$key] = $value;
             }
          }

          return $headers;
    }



    /**
     * Returns user
     *
     * @return mixed|null
    */
    public function getUser(): mixed
    {
        return $this->get('PHP_AUTH_USER');
    }



    /**
     * Returns password
     *
     * @return mixed|null
    */
    public function getPassword(): mixed
    {
        return $this->get('PHP_AUTH_PW');
    }



    /**
     * @return string
    */
    public function getAuthority(): string
    {
         if (! $user = $this->getUser()) {
              return '';
         }

         return sprintf('%s:%s@', $user, $this->getPassword());
    }





    /**
     * Returns scheme protocol
     *
     * @return string
    */
    public function getScheme(): string
    {
        return $this->isSecure() ? 'https' : 'http';
    }





    /**
     * @return string
    */
    public function getBaseURL(): string
    {
        return sprintf('%s://%s%s', $this->getScheme(), $this->getAuthority(), $this->getHost());
    }





    /**
     * @return string
    */
    public function getURL(): string
    {
         return sprintf('%s%s', $this->getBaseURL(), $this->getRequestUri());
    }



    /**
     * Determine if request via xhr http request
     *
     * @return bool
    */
    public function isXhr(): bool
    {
        return $this->get('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
    }




    /**
     * @param string $hostname
     *
     * @return false|int
    */
    public function isValidHost(string $hostname): bool|int
    {
         return preg_match("#^$hostname$#", $this->getHost());
    }





    /**
     * @return bool
    */
    public function isForwardedProto(): bool
    {
        return $this->get('HTTP_X_FORWARDED_PROTO') == 'https';
    }



    /**
     * @return bool
    */
    public function isHttps(): bool
    {
        return $this->has('HTTPS') || $this->isForwardedProto();
    }





    /**
     * Determine if the HTTP protocol is secure
     * @return bool
    */
    public function isSecure(): bool
    {
        return $this->isHttps() && $this->getPort() == 443;
    }





    /**
     * Determine if the request method matched
     *
     * @param string $name
     *
     * @return bool
    */
    public function isMethod(string $name): bool
    {
        return $this->getRequestMethod() === strtoupper($name);
    }
}