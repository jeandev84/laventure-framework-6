<?php
namespace Laventure\Component\Http\Message\Client\cUrl;

use CurlHandle;
use Laventure\Component\Http\Message\Client\cUrl\Service\cUrlInfo;
use Laventure\Component\Http\Message\Request\Bag\RequestHeaderBag;
use Laventure\Component\Http\Message\Request\Contract\RequestInterface;
use Laventure\Component\Http\Message\Request\Contract\UriInterface;
use Laventure\Component\Http\Message\Request\Uri;
use Laventure\Component\Http\Message\StreamInterface;


/**
 * @Request
 *
 * @link https://www.php.net/manual/en/function.parse-url.php
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client\cURL
*/
class cUrlRequest implements RequestInterface
{


    /**
     * @var resource|false|CurlHandle
    */
    protected $ch;



    /**
     * @var UriInterface
    */
    protected UriInterface $uri;


    /**
     * @var string|null
    */
    protected string|null $method;


    /**
     * @var string|null
    */
    protected ?string $protocol;



    /**
     * @var string|null
    */
    protected ?string $requestTarget;



    /**
     * @var RequestHeaderBag
    */
    protected RequestHeaderBag $headers;



    /**
     * @var bool[]
    */
    protected $defaultOptions = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_HEADER => false
    ];




    /**
     * @param string|null $url
    */
    public function __construct(string $url = null)
    {
        $this->ch      = curl_init($url);
        $this->headers = new RequestHeaderBag();
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
     * @inheritDoc
    */
    public function getProtocolVersion()
    {
        return $this->protocol;
    }




    /**
     * @inheritDoc
    */
    public function withProtocolVersion($version): static
    {
        $this->protocol = $version;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getHeaders(): array
    {
        return $this->headers->all();
    }




    /**
     * @inheritDoc
    */
    public function hasHeader($name): bool
    {
        return $this->headers->has($name);
    }



    /**
     * @inheritDoc
    */
    public function getHeader($name)
    {
        return $this->headers->get($name);
    }




    /**
     * @inheritDoc
    */
    public function getHeaderLine($name)
    {

    }




    /**
     * @inheritDoc
    */
    public function withHeader($name, $value): static
    {
        $this->headers[$name] = $value;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withAddedHeader($name, $value)
    {
        if ($this->headers->has($name)) {
            $this->headers->set($name, $value);
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }




    /**
     * @inheritDoc
    */
    public function getBody()
    {
        // TODO: Implement getBody() method.
    }



    /**
     * @inheritDoc
    */
    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }



    /**
     * @inheritDoc
    */
    public function url()
    {
        return $this->uri;
    }



    /**
     * @inheritDoc
    */
    public function withRequestTarget($requestTarget)
    {

    }



    /**
     * @inheritDoc
    */
    public function getMethod()
    {
        return $this->method;
    }




    /**
     * @inheritDoc
    */
    public function withMethod($method): static
    {
        $this->method = $method;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getUrl(): UriInterface
    {
        return $this->uri;
    }



    /**
     * @inheritDoc
    */
    public function withUri(UriInterface $uri, $preserveHost = false): static
    {
         $this->uri = $uri;

         return $this;
    }
}