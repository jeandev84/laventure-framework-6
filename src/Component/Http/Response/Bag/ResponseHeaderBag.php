<?php
namespace Laventure\Component\Http\Response\Bag;

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
 * @package Laventure\Component\Http\Response\Bag
*/
class ResponseHeaderBag extends ParameterBag
{

    /**
     * @var bool
    */
    protected $statusCodeSent = false;


    /**
     * @var array
    */
    protected static $parsedHeaders = [];


    /**
     * @inheritdoc
    */
    public function __construct(array $params = [])
    {
        $parsedHeaders = $this->parseHeaders(headers_list());

        parent::__construct(array_merge($parsedHeaders));
    }



    /**
     * @return bool
    */
    public function sentHeaders(): bool
    {
        return headers_sent();
    }




    /**
     * @return void
    */
    public function sendHeaders(): void
    {
        foreach ($this->params as $name => $value) {
            if (! isset(static::$parsedHeaders[$name])) {
                $this->sendHeader("$name: $value");
            }
        }
    }




    /**
     * @param string $header
     *
     * @param bool $replace
     *
     * @param int $responseCode
     *
     * @return void
    */
    public function sendHeader(string $header, bool $replace = true, int $responseCode = 0): void
    {
          header($header, $replace, $responseCode);
          $this->parseHeader($header);
    }



    /**
     * @param string $version
     *
     * @param int $code
     *
     * @param string $reasonPhrase
     *
     * @return bool
    */
    public function sendStatusCode(string $version, int $code, string $reasonPhrase = ''): bool
    {
        if (! $this->statusCodeSent) {
            $reasonPhrase ? header("$version $code $reasonPhrase") : http_send_status($code);
            $this->statusCodeSent = true;
        }

        return $this->statusCodeSent;
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
         if (! $this->has($name)) {
              return "";
         }

         if (! is_array($this->get($name))) {
              return "";
         }

         return join(";", array_values($this->get($name)));
    }




    /**
     * @inheritdoc
    */
    public function has(string $name): bool
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
    public function parseHeaders(array $headers): array
    {
         foreach ($headers as $header) {
             $this->parseHeader($header);
         }

         return static::$parsedHeaders;
    }



    /**
     * @param string $header
     *
     * @return void
    */
    public function parseHeader(string $header): void
    {
        [$name, $value] = explode(':', $header, 2);
        self::$parsedHeaders[$name] = $value;
    }
}