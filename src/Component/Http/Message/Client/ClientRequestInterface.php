<?php
namespace Laventure\Component\Http\Message\Client;


/**
 * @ClientRequestInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client
*/
interface ClientRequestInterface
{

    /**
     * Returns client name
     *
     * @return string
    */
    public function getName(): string;



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