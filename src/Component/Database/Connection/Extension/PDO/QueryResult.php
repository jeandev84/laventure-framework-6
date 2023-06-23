<?php
namespace Laventure\Component\Database\Connection\Extension\PDO;

use Laventure\Component\Database\Connection\Query\Contract\QueryInterface;
use Laventure\Component\Database\Connection\Query\Contract\QueryResultInterface;

class QueryResult implements QueryResultInterface
{

    /**
     * @var QueryInterface
     */
     protected $query;



     /**
      * @param Query $query
      *
      * @throws \Laventure\Component\Database\Connection\Query\QueryException
     */
     public function __construct(Query $query)
     {
         $query->execute();

         $this->query = $query;
     }



     /**
      * @inheritDoc
     */
     public function all()
     {
        // TODO: Implement all() method.
     }



    /**
     * @inheritDoc
    */
    public function one()
    {
        // TODO: Implement one() method.
    }



    /**
     * @inheritDoc
    */
    public function assoc()
    {
        // TODO: Implement assoc() method.
    }



    /**
     * @inheritDoc
    */
    public function column()
    {
        // TODO: Implement column() method.
    }




    /**
     * @inheritDoc
    */
    public function columns()
    {
        // TODO: Implement columns() method.
    }

    /**
     * @inheritDoc
     */
    public function object()
    {
        // TODO: Implement object() method.
    }
}