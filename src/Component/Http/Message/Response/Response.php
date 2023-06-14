<?php
namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Stream\TempFile;
use Laventure\Component\Http\Message\StreamInterface;
use Laventure\Component\Http\Message\Response\Bag\ResponseHeaderBag;
use Laventure\Component\Http\Message\Response\Body\ResponseBody;
use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;
use Laventure\Component\Http\Message\Response\StatusCode\ResponseStatusCode;


/**
 * @cUrlResponse
 *
 * @link https://www.php.net/manual/en/function.parse-url.php
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\cUrlResponse
*/
class Response extends ResponseStatusCode implements ResponseInterface
{

    /**
     * cUrlResponse body
     *
     * @var StreamInterface
    */
    protected $body;



    /**
     * cUrlResponse content
     *
     * @var string
    */
    protected $content;




    /**
     * cUrlResponse status code
     *
     * @var int
    */
    protected $statusCode;




    /**
     * Status reason phrase
     *
     * @var string
    */
    protected $reasonPhrase = '';




    /**
     * cUrlResponse headers
     *
     * @var ResponseHeaderBag
    */
    public $headers;




    /**
     * Server HTTP protocol version
     *
     * @var string
    */
    protected $version;


     /**
      * @param null $content
      *
      * @param int $statusCode
      *
      * @param array $headers
     */
     public function __construct($content = null, int $statusCode = 200, array $headers = [])
     {
          $this->content    = $content;
          $this->statusCode = $statusCode;
          $this->headers    = new ResponseHeaderBag($headers);
          $this->body       = new ResponseBody();
     }




    /**
     * @param string|null $content
     *
     * @return $this
    */
    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }




    /**
     * @return string|null
    */
    public function getContent(): ?string
    {
        return $this->content;
    }



    /**
     * @inheritDoc
    */
    public function getProtocolVersion(): ?string
    {
         return $this->version;
    }




    /**
     * @inheritDoc
    */
    public function withProtocolVersion($version): static
    {
        $this->version = $version;

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
    public function getHeader($name): mixed
    {
        return $this->headers->get($name);
    }




    /**
     * @inheritDoc
    */
    public function getHeaderLine($name): string
    {
        return $this->headers->getHeaderLine($name);
    }





    /**
     * @inheritDoc
    */
    public function withHeader($name, $value): static
    {
        $this->headers->set($name, $value);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withAddedHeader($name, $value): static
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
         $this->headers->remove($name);
    }





    /**
     * @inheritDoc
    */
    public function getBody(): StreamInterface
    {
        return $this->body;
    }





    /**
     * @inheritDoc
    */
    public function withBody(StreamInterface $body): static
    {
        $this->body = $body;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }




    /**
     * @inheritDoc
    */
    public function withStatus($code, $reasonPhrase = ''): static
    {
         $this->statusCode   = $code;
         $this->reasonPhrase = $reasonPhrase;

         return $this;
    }



    /**
     * @inheritDoc
    */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }



    /**
     * @return void
    */
    public function sendHeaders(): void
    {
         $this->headers->sendHeaders();
    }



    /**
     * Remove all headers
     *
     * @return bool
    */
    public function removeHeaders(): bool
    {
         $this->headers->removeHeaders();

         return empty($this->headers->all());
    }



    /**
     * @return void
    */
    public function sendBody(): void
    {
        echo $this->getContent();
    }





    /**
     * @return void
    */
    public function sendStatusCode(): void
    {
        $this->headers->sendStatusCode($this->getProtocolVersion(), $this->getStatusCode(), $this->getReasonPhrase());
    }



    /**
     * @return void
    */
    public function send(): void
    {
        $this->sendStatusCode();
        $this->sendHeaders();
    }



    /**
     * Display response has string
     *
     * @return string
    */
    public function __toString(): string
    {
        return $this->content;
    }
}