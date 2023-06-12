<?php
namespace Laventure\Component\Http\Bag;


/**
 * @ClientParameterBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Bag
*/
class ClientParameterBag extends ParameterBag
{


    /**
     * @var array
    */
    protected $config = [
        "headers"    => [],
        "query"      => [],
        "files"      => [],
        "data"    => [],
        "body"       => null
    ];




    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        parent::__construct($this->config);

        $this->merge($params);
    }




    /**
     * @return array
    */
    public function getQuery(): array
    {
        return $this->get('query', []);
    }





    /**
     * @return array
    */
    public function getHeaders(): array
    {
        return $this->get("headers", []);
    }





    /**
     * @return string|null
    */
    public function getContent(): ?string
    {
        if (! is_string($content = $this->getBody())) {
             return '';
        }

        return $content;
    }





    /**
     * @return mixed|null
    */
    public function getBody(): mixed
    {
        return $this->get('body');
    }





    /**
     * @return array
    */
    public function getParsedBody(): array
    {
        return $this->get('body', []);
    }





    /**
     * @return array
    */
    public function getCookies(): array
    {
         return $this->get("data", []);
    }




    /**
     * @return array
    */
    public function getFiles(): array
    {
        return $this->get("files", []);
    }






    /**
     * @return array
    */
    public function getServerParams(): array
    {
        return $_SERVER;
    }
}