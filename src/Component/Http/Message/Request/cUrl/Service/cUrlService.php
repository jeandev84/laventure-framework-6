<?php
namespace Laventure\Component\Http\Message\Client\cUrl\Service;

use CurlHandle;

class cUrlService
{


   /**
    * @var resource|false|CurlHandle
   */
   protected $ch;


    /**
     * @var bool[]
   */
   protected $defaultOptions = [
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_SSL_VERIFYPEER => true,
       CURLOPT_HEADER => false
   ];



   /**
    * @var array
   */
   protected $headers = [];



   /**
    * @param string|null $url
   */
   public function __construct(string $url = null)
   {
       $this->init($url);
   }




   /**
     * @param string $url
     *
     * @return $this
   */
   public function init(string $url): static
   {
       $this->ch = curl_init($url);

       $this->setOptions($this->defaultOptions);

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

        return $this;
    }




    /**
     * @param array $options
     *
     * @return $this
    */
    public function setOptions(array $options): static
    {
        curl_setopt_array($this->ch, $options);

        return $this;
    }




    /**
     * @param string $url
     *
     * @return $this
    */
    public function setUrl(string $url): static
    {
        $this->setOption(CURLOPT_URL, $url);

        return $this;
    }




    /**
     *
     * @param string $method
     *
     * @return $this
    */
    public function setRequestMethod(string $method): static
    {
        return $this->setOption(CURLOPT_CUSTOMREQUEST, $method);
    }




    /**
     * Set user agent
     *
     * @param string $agent
     *
     * @return $this
    */
    public function setUserAgent(string $agent): static
    {
        $this->setOption(CURLOPT_USERAGENT, $agent);

        return $this;
    }




    /**
     * @param array $headers
     *
     * @return $this
    */
    public function setHeaders(array $headers): static
    {
        $this->setOption(CURLOPT_HTTPHEADER, $this->resolveHeaders($headers));

        return $this;
    }





    /**
     * @param array $fields
     *
     * @return $this
    */
    public function setPostFields(array $fields): static
    {
        return $this->setOption(CURLOPT_POSTFIELDS, http_build_query($fields));
    }






    /**
     * @return bool|string
    */
    public function exec()
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
     * @param $option
     *
     * @return mixed
    */
    public function getInfo($option): mixed
    {
       return curl_getinfo($this->ch, $option);
    }




    /**
     * @return mixed
    */
    public function getInfos(): mixed
    {
        return curl_getinfo($this->ch);
    }




    /**
     * @param string $url
     *
     * @param array $query
     *
     * @return mixed
    */
    public function get(string $url, array $query = []): cUrlInfo
    {
        $curl = new static($query ? $url . '?'. http_build_query($query) : $url);
        $info = new cUrlInfo($this->ch);
        $info->setResponse($curl->exec());
        return $info;
    }





    /**
     * @param string $url
     * @param array $attributes
     * @return $this
    */
    public function post(string $url, array $attributes = []): static
    {
         $curl = new static($url);
         $curl->setOption(CURLOPT_POST, 1);
         return $curl;
    }




    public function put(string $url): static
    {

    }


    public function delete(string $url, array $options = []): static
    {

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