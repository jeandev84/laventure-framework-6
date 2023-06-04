<?php
namespace Laventure\Component\Http\Message\Client;

use Laventure\Component\Http\Message\Response\Contract\ResponseInterface;

/**
 * @HttpClientInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client
*/
interface HttpClientInterface extends ClientInterface
{


     /**
      * Send request to client and get a response by each method
      *
      * @param string $method
      *
      * @param string $url
      *
      * @param array $options
      *
      * @return mixed
     */
     public function send(string $method, string $url, array $options = []): ResponseInterface;




     /**
      * Send request to client by method GET
      *
      * @param string $url
      *
      * @param array $options
      *
      * @return mixed
     */
     public function get(string $url, array $options = []): ResponseInterface;





     /**
      * Send request to client by method POST
      *
      * @param string $url
      *
      * @param array $options
      *
      * @return mixed
     */
     public function post(string $url, array $options = []): ResponseInterface;






    /**
     * Send request to client by method PUT
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
     */
    public function put(string $url, array $options = []): ResponseInterface;







    /**
     * Send request to client by method PATCH
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
    */
    public function patch(string $url, array $options = []): ResponseInterface;






    /**
     * Send request to client by method DELETE
     *
     * @param string $url
     *
     * @param array $options
     *
     * @return mixed
     */
    public function delete(string $url, array $options = []): ResponseInterface;
}