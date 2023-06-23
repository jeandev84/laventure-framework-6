<?php
namespace Laventure\Component\Database\Connection\Query\Contract;

interface QueryInterface
{
     /**
      * Simple query
      *
      * @param string $sql
      *
      * @return $this
     */
     public function query(string $sql): static;





     /**
      * Prepare sql statement
      *
      * @param string $sql
      *
      * @return $this
     */
     public function prepare(string $sql): static;





     /**
      * Bind query params
      *
      * @param array $params
      *
      * @return $this
     */
     public function bindParams(array $params): static;







     /**
      * Bind query values
      *
      * @param array $values
      *
      * @return $this
     */
     public function bindValues(array $values): static;




     /**
      * Bind query columns
      *
      * @param array $columns
      * @return $this
     */
     public function bindColumns(array $columns): static;



     /**
      * Execute query
      *
      * @param array $parameters
      *
      * @return mixed
     */
     public function execute(array $parameters = []);






     /**
      * @return QueryResultInterface
     */
     public function fetch(): QueryResultInterface;






     /**
      * @return array
     */
     public function getBindParams(): array;




     /**
      * @return array
     */
     public function getBindValues(): array;




     /**
      * @return array
     */
     public function getBindColumns(): array;
}