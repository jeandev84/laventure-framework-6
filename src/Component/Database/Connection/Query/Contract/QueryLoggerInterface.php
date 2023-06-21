<?php
namespace Laventure\Component\Database\Connection\Query\Contract;

interface QueryLoggerInterface
{

    /**
     * @return mixed
    */
    public function getExecutedQueries();





    /**
     * @return mixed
    */
    public function getErrors();
}