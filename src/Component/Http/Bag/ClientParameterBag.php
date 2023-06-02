<?php
namespace Laventure\Component\Http\Bag;

class ClientParameterBag extends ParameterBag
{


    /**
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        parent::__construct($this->mergeParameters($params));
    }





    /**
     * @param array $params
     *
     * @return array
    */
    private function mergeParameters(array $params): array
    {
         return array_merge([
             "headers"    => [],
             "cookies"    => [],
             "attributes" => [],
             "files"      => [],
             "body"       => null
         ], $params);
    }




    /**
     * @return array
    */
    public function getHeaders(): array
    {
        return $this->get("headers", []);
    }




    /**
     * @return array
    */
    public function getCookies(): array
    {
         return $this->get("cookies", []);
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
    public function getAttributes(): array
    {
        return $this->get("attributes", []);
    }
}