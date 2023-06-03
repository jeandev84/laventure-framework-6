<?php
namespace Laventure\Component\Message\Http\Client\Service;

use CurlHandle;
use Laventure\Component\Http\Bag\clientParameterBag;
use Laventure\Component\Http\Bag\ParameterBag;


/**
 * @cURL
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Message\Http\Client\Upload
*/
class cURL
{

    /**
     * cUrl Handler
     *
     * @var resource|false|CurlHandle
    */
    protected $ch;


    /**
     * @param string $url
    */
    public function __construct(string $url)
    {
         $this->ch = curl_init($url);
    }




    /**
     * @param $name
     *
     * @param $value
     * @return $this
    */
    public function setOption($name, $value): static
    {
         curl_setopt($this->ch, $name, $value);

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
     * @param clientParameterBag $parameterBag
     *
     * @return $this
    */
    public function setOptionsFromParameterBag(clientParameterBag $parameterBag): static
    {
         return $this;
    }





    /**
     * @param array $headers
     *
     * @return $this
    */
    public function setHeaders(array $headers): static
    {
         return $this;
    }




    /**
     * @return int
    */
    public function getStatusCode(): int
    {
         return 200;
    }




    /**
     * @return array
    */
    public function getHeaders(): array
    {
         return [];
    }



    /**
     * @return bool|string
    */
    public function exec(): bool|string
    {
         return curl_exec($this->ch);
    }
}