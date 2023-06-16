<?php
namespace Laventure\Component\Http\Message\Client;

use Laventure\Component\Http\Message\Client\Service\Stream\Option\StreamOptionInterface;

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
           $url .= $this->buildQuery($queries);
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
     * @return string|null
    */
    public function getUrl(): ?string
    {
        return $this->url;
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
    public function getHeaders(): array
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
        $headersRows = $this->getHeaders();

        $headers = [];

        foreach ($headersRows as $header) {
            if(stripos($header, ':') !== false) {
                [$name, $value] = explode(':', $header, 2);
                $headers[$name] = $value;
            }
        }

        return $headers;
    }





    /**
     * @return array
    */
    public function getHeadersInfo(): array
    {
        if (empty($this->getHeaders()[0])) {
            return [null, 200, []];
        }

        $responseHeader = $this->getHeaders()[0];

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
    protected function buildQuery(array $parameters, string $separator = null): string
    {
        return http_build_query($parameters, '', $separator ?? '&');
    }
}