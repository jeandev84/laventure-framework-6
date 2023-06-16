<?php
namespace Laventure\Component\Http\Message\Client;


class ClientResponse implements ClientResponseInterface
{

    /**
     * @var string|null
     */
    protected ?string $body;



    /**
     * @var int
     */
    protected int $status;



    /**
     * @var string|null
     */
    protected ?string $version;



    /**
     * @var string|null
     */
    protected ?string $reasonPhrase;



    /**
     * @var array
     */
    protected array $headers = [];




    /**
     * @param string|null $body
     *
     * @param int $statusCode
     *
     * @param array $headers
    */
    public function __construct(?string $body = null, int $statusCode = 200, array $headers = [])
    {
        $this->body    = $body;
        $this->status  = $statusCode;
        $this->headers = $headers;
    }



    /**
     * @param string|null $body
     *
     * @return $this
     */
    public function setBody(?string $body): static
    {
        $this->body = $body;

        return $this;
    }





    /**
     * @param int $statusCode
     *
     * @return $this
     */
    public function setStatusCode(int $statusCode): static
    {
        $this->status = $statusCode;

        return $this;
    }




    /**
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers): static
    {
        $this->headers = $headers;

        return $this;
    }



    /**
     * @param string|null $version
     *
     * @return $this
     */
    public function setProtocolVersion(?string $version): static
    {
        $this->version = $version;

        return $this;
    }




    /**
     * @param string|null $reasonPhrase
     *
     * @return $this
    */
    public function setReasonPhrase(?string $reasonPhrase): static
    {
        $this->reasonPhrase = $reasonPhrase;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function getBody(): ?string
    {
        return $this->body;
    }




    /**
     * @inheritDoc
    */
    public function getHeaders(): array
    {
        return $this->headers;
    }




    /**
     * @inheritDoc
    */
    public function getStatusCode(): int
    {
        return $this->status;
    }





    /**
     * @inheritDoc
    */
    public function getReasonPhrase(): ?string
    {
        return $this->reasonPhrase;
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
    public function isSuccess(): bool
    {
        return ($this->status === 200);
    }
}