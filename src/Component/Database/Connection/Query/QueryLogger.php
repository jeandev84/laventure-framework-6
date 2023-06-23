<?php
namespace Laventure\Component\Database\Connection\Query;

use Laventure\Component\Database\Connection\Query\Contract\QueryLoggerInterface;

class QueryLogger implements QueryLoggerInterface
{


    /**
     * @var string
    */
    protected $sql;



    /**
     * @var array
    */
    protected $data = [];



    /**
     * @param string $sql
    */
    public function setSql(string $sql): void
    {
        $this->sql = $sql;
    }




    /**
     * @inheritDoc
    */
    public function logQueryParams(array $data)
    {
        $this->data = $data;
    }



    /**
     * @inheritDoc
    */
    public function logQueryErrors(\Exception $e)
    {
        $this->logQueryParams([
            'sql'     => $this->sql,
            'code'    => $e->getCode(),
            'message' => $e->getMessage(),
            'line'    => $e->getLine(),
            'file'    => $e->getFile(),
            'type'    => get_class($e)
        ]);

        throw new QueryException($e->getMessage(), $e->getCode());
    }




    /**
     * @inheritDoc
    */
    public function toArray()
    {
        return $this->data;
    }
}