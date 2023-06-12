<?php
namespace Laventure\Component\Http\Message\Response\Bag;

use Laventure\Component\Http\Bag\ParameterBag;

/**
 * @ResponseHeaderBag
 *
 * @link https://www.php.net/manual/en/function.parse-url.php
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\cUrlResponse\Bag
*/
class ResponseHeaderBag extends ParameterBag
{

    /**
     * @var bool
    */
    protected $sent = false;


    /**
     * @var array
    */
    protected $parsedHeaders = [];


    /**
     * @var array
    */
    protected $sendedHeaders = [];



    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        parent::__construct($this->parseHeaders($params));
    }




    /**
     * @return bool
    */
    public function sentHeaders()
    {
         return $this->sent = headers_sent();
    }




    /**
     * @return void
    */
    public function sendHeaders(): void
    {
        foreach ($this->config as $name => $value) {
            $this->sendHeader("$name: $value");
            $this->sendedHeaders[$name] = $value;
        }
    }




    /**
     * @param string $header
     *
     * @param bool $replace
     *
     * @param int $responseCode
     *
     * @return $this
    */
    public function sendHeader(string $header, bool $replace = true, int $responseCode = 0): static
    {
         header($header, $replace, $responseCode);

         return $this;
    }




    /**
     * @param string $version
     *
     * @param int $code
     *
     * @param string $reasonPhrase
     *
     * @return void
    */
    public function sendStatusCode($version, $code, $reasonPhrase = '')
    {
        if (! $reasonPhrase) {
            http_response_code($code);
        } else {
            $this->sendHeader("$version $code $reasonPhrase");
        }
    }




    /**
     * Remove all headers
     *
     * @return void
    */
    public function removeHeaders(): void
    {
         foreach ($this->all() as $name => $value) {
              $this->remove($name);
              $this->removeHeader($name);
         }
    }





    /**
     * Remove headers
     *
     * @param string $name
     * @return void
    */
    public function removeHeader(string $name): void
    {
         header_remove($name);
    }




    /**
     * @param string $name
     *
     * @return string
    */
    public function getHeaderLine(string $name): string
    {
         $lines = $this->get($name);

         if (! is_array($lines)) {
              return "";
         }

         return join(";", array_values($lines));
    }




    /**
     * @inheritdoc
    */
    public function has($name): bool
    {
        $parsedHeaders = $this->parseHeaders($this->all());

        return isset($parsedHeaders[$name]);
    }




    /**
     * Parse response headers
     *
     * @param array $headers
     *
     * @return array
    */
    private function parseHeaders(array $headers): array
    {
         foreach (headers_list() as $header) {
             $this->parseHeaderString($header);
         }

         return array_merge($this->parsedHeaders, $headers);
    }




    /**
     * Parse header from string
     *
     * @param string $header
     *
     * @return array
    */
    private function parseHeaderString(string $header): array
    {
        [$name, $value] = explode(':', $header, 2);

        $this->parsedHeaders[$name] = $value;

        return $this->parsedHeaders;
    }
}