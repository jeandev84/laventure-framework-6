<?php
namespace Laventure\Component\Http\Message\Client\Service;

use CurlHandle;
use Laventure\Component\Http\Message\Client\Service\Exception\cUrlServiceException;

class cUrlService
{


    /**
     * @var CurlHandle|false
    */
    protected $ch;



    /**
     * @var bool[]
    */
    protected $defaultOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER => false
    ];




    /**
     * @param string|null $url
    */
    public function __construct(string $url = null)
    {
         $this->init($url);
    }




    /**
     * @param string|null $url
     *
     * @return $this
    */
    public function init(string $url = null): static
    {
        $this->ch = curl_init($url);

        $this->options($this->defaultOptions);

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
     * @param string $url
     *
     * @param array $queries
     *
     * @return $this
    */
    public function url(string $url, array $queries = []): static
    {
        if ($queries) {
            $url .= '?' . http_build_query($queries);
        }

        return $this->option(CURLOPT_URL, $url);
    }



    /**
     * @param bool $auth
     *
     * @return $this
    */
    public function useAuthentication(bool $auth): static
    {
        return $this->options([
            CURLOPT_USERPWD => $auth,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC
        ]);
    }




    /**
     * @param string $method
     *
     * @param array $data
     *
     * @return $this
    */
    public function request(string $method, array $data = []): static
    {
        if ($method === 'GET') {
             return $this;
        } elseif ($method === 'POST') {
             $this->option(CURLOPT_POST, 1);
        } else {
            $this->option(CURLOPT_CUSTOMREQUEST, $method);
        }

        $fields = http_build_query($data, '', '&');

        return $this->options([
            CURLOPT_POSTFIELDS => $fields
        ]);
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
     * @param array $headers
     *
     * @return $this
    */
    public function headers(array $headers): static
    {
        $this->option(CURLOPT_HTTPHEADER, $this->resolveHeaders($headers));

        return $this;
    }




    /**
     * @param array $cookies
     *
     * @return $this
    */
    public function cookies(array $cookies): static
    {
        return $this;
    }




    /**
     * @param array $files
     *
     * @return $this
    */
    public function files(array $files): static
    {
        return $this;
    }






    /**
     * @param bool $return
     *
     * @return $this
    */
    public function returnHeaders(bool $return): static
    {
         $this->option(CURLOPT_HEADER, $return);

         return $this;
    }




    /**
     * @return cUrlInfo
     *
     * @throws cUrlServiceException
    */
    public function exec(): cUrlInfo
    {
        try {

           return new cUrlInfo($this->ch);

        } catch (\Throwable $e) {

            throw new cUrlServiceException($e->getMessage(), $e->getCode());
        }
    }




    /**
     * @param array $headers
     *
     * @return array
    */
    private function resolveHeaders(array $headers): array
    {
        $resolved = [];

        foreach ($headers as $name => $value) {
            $resolved[] = "$name: $value";
        }

        return $resolved;
    }
}