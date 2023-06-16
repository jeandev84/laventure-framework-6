<?php
namespace Laventure\Component\Http\Message\Client;

interface ClientRequestInterface
{
    /**
     * @param string $method
     *
     * @param string $url
     *
     * @param array $context
     *
     * @return ClientResponseInterface
    */
    public function request(string $method, string $url, array $context = []): ClientResponseInterface;
}