<?php
namespace Laventure\Component\Http\Message\Client;


/**
 * @ClientRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\Client
*/
abstract class ClientRequest implements ClientRequestInterface
{

    /**
     * @var string|null
    */
    protected ?string $url = null;



     /**
      * @var string|null
     */
     protected ?string $method = 'GET';



    /**
     * @var array
    */
    protected array $queries = [];



    /**
     * @var array
    */
    protected array $options = [];




    /**
     * @param string $url
     *
     * @param array $queries
     *
     * @return $this
    */
    public function url(string $url, array $queries = []): static
    {
        if ($queries) {
           $url .= $this->buildQueryParams($queries);
        }

        $this->url     = $url;
        $this->queries = $queries;

        return $this;
    }




    /**
     * @param string $method
     *
     * @return $this
    */
    public function method(string $method): static
    {
        $this->method = $method;

        return $this;
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
         $this->options[$key] = $value;

         return $this;
    }





    /**
     * @param array $options
     *
     * @return $this
    */
    public function setOptions(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }




    /**
     * @return string|null
    */
    public function getUrl(): ?string
    {
        return $this->url;
    }




    /**
     * @return string|null
    */
    public function getMethod(): ?string
    {
        return $this->method;
    }




    /**
     * @return array
    */
    public function getQueries(): array
    {
        return $this->queries;
    }






    /**
     * @return array
    */
    public function getOptions(): array
    {
        return $this->options;
    }






    /**
     * @return array
    */
    public function getAllHeaders(): array
    {
        if(! $headers = get_headers($this->url)) {
            return [];
        }

        return $headers;
    }




    /**
     * @return array
    */
    public function getResponseHeaders(): array
    {
        return $this->filterHeaders($this->getAllHeaders());
    }





    /**
     * @return array
    */
    public function getHeadersInfo(): array
    {
        if (empty($this->getAllHeaders()[0])) {
            return [null, 200, []];
        }

        $responseHeader = $this->getAllHeaders()[0];

        $info = explode(' ', $responseHeader, 3);

        if (count($info) !== 3) {
            return [null, 200, []];
        }

        return $info;
    }




    /**
     * @param string $proxy
     *
     * @return bool
    */
    protected function isProxy(string $proxy): bool
    {
        return stripos($proxy, ':') !== false;
    }



    /**
     * @param array $headerRows
     *
     * @return array
    */
    protected function filterHeaders(array $headerRows): array
    {
        $headers = [];

        foreach ($headerRows as $header) {
            $position = stripos($header, ':');
            if($position !== false) {
                [$name, $value] = explode(':', $header, 2);
                $headers[$name] = trim($value);
            }
        }

        return $headers;
    }




    /**
     * @param array $headers
     *
     * @return array
    */
    protected function resolveHeaders(array $headers): array
    {
        $resolved = [];

        foreach ($headers as $key => $value) {
            $resolved[] = (is_string($key) ? "$key: $value" : $value);
        }

        return $resolved;
    }




    /**
     * @param array $parameters
     *
     * @param string|null $separator
     *
     * @return string
    */
    protected function buildQueryParams(array $parameters, string $separator = null): string
    {
        return http_build_query($parameters, '', $separator ?? '&');
    }





    /**
     * Send request and return response
     *
     * @return ClientResponseInterface
    */
    abstract public function send(): ClientResponseInterface;
}