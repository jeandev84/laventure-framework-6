<?php
namespace Laventure\Component\Http\Message\Client;

class ClientRequestCollection
{

    /**
     * @var ClientRequest[]
    */
    protected $clients = [];



    /**
     * Add client request
     *
     * @param ClientRequest $request
     *
     * @return $this
    */
    public function add(ClientRequest $request): static
    {
         $this->clients[$request->getName()] = $request;

         return $this;
    }




    /**
     * @param string $name
     *
     * @return ClientRequest
     *
     * @throws ClientException
    */
    public function get(string $name): ClientRequest
    {
        if (! array_key_exists($name, $this->clients)) {
            throw new ClientException("Service client '$name' does not exist.");
        }

        return $this->clients[$name];
    }
}