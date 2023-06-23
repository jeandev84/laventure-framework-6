<?php
namespace Laventure\Component\Database\Connection\Extension\PDO;

use Laventure\Component\Database\Connection\Query\Contract\QueryInterface;
use Laventure\Component\Database\Connection\Query\Contract\QueryResultInterface;
use Laventure\Component\Database\Connection\Query\QueryException;
use Laventure\Component\Database\Connection\Query\QueryLogger;
use PDO;
use PDOStatement;

class Query implements QueryInterface
{

    /**
     * @var PDO
    */
    protected PDO $pdo;




    /**
     * @var PDOStatement
    */
    protected PDOStatement $statement;



    /**
     * @var QueryLogger
    */
    protected QueryLogger $logger;



    /**
     * @var array
    */
    protected array $bindings = [];



    /**
     * @param PDO $pdo
    */
    public function __construct(PDO $pdo)
    {
        $this->pdo       = $pdo;
        $this->statement = new PDOStatement();
        $this->logger    = new QueryLogger();
    }




    /**
     * @inheritDoc
    */
    public function prepare(string $sql): static
    {
        $this->statement = $this->pdo->prepare($sql);

        $this->logger->setSql($sql);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function query(string $sql): static
    {
        $this->statement = $this->pdo->query($sql);

        $this->logger->setSql($sql);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function bindParams(array $params): static
    {
        foreach ($params as $key => $value) {
            $this->statement->bindParam($key, $value);
        }

        $this->bindings['params'][] = $params;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function bindColumns(array $columns): static
    {
         foreach ($columns as $key => $value) {
             $this->statement->bindColumn($key, $value);
         }

         $this->bindings['columns'][] = $columns;

         return $this;
    }






    /**
     * @inheritDoc
    */
    public function bindValues(array $values): static
    {
         foreach ($values as $key => $value) {
            $this->statement->bindValue($key, $value);
         }

         $this->bindings['values'][] = $values;

         return $this;
    }





    /**
     * @inheritDoc
     * @throws QueryException
     */
    public function execute(array $parameters = [])
    {
        try {

            if ($this->statement->execute($parameters)) {
                  $this->logger->logQueryParams([
                      'sql'            => $this->statement->queryString,
                      'bindings'       => $this->bindings,
                      'executedParams' => $parameters
                  ]);
            }

        } catch (\PDOException $e) {
             $this->logger->logQueryErrors($e);
        }
    }





    /**
     * @inheritDoc
     */
    public function fetch(): QueryResultInterface
    {
         return new QueryResult($this);
    }



    /**
     * @inheritDoc
    */
    public function getBindParams(): array
    {
        return $this->bindings['params'] ?? [];
    }



    /**
     * @inheritDoc
    */
    public function getBindValues(): array
    {
        return $this->bindings['values'] ?? [];
    }




    /**
     * @inheritDoc
    */
    public function getBindColumns(): array
    {
        return $this->bindings['columns'] ?? [];
    }
}