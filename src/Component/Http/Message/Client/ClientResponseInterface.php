<?php
namespace Laventure\Component\Http\Message\Client;

interface ClientResponseInterface
{

    /**
     * @return string|null
    */
    public function getBody(): ?string;




    /**
     * @return array
    */
    public function getHeaders(): array;




    /**
     * @return int
    */
    public function getStatusCode(): int;



    /**
     * @return string|null
    */
    public function getReasonPhrase(): ?string;



    /**
     * @return string|null
    */
    public function getProtocolVersion(): ?string;




    /**
     * @return bool
    */
    public function isSuccess(): bool;
}