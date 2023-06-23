<?php
namespace Laventure\Component\Database\Connection\Query\Contract;

interface QueryLoggerInterface
{


    /**
     * @param array $data
     *
     * @return mixed
    */
    public function logQueryParams(array $data);



    /**
     * @param \Exception $e
     *
     * @return mixed
    */
    public function logQueryErrors(\Exception $e);




    /**
     * @return mixed
    */
    public function toArray();
}