<?php
namespace Laventure\Component\Database\Connection\Query\Contract;

interface QueryResultInterface
{

     /**
      * Fetch all result
      *
      * @return mixed
     */
     public function all();




     /**
      * Fetch one result
      *
      * @return mixed
     */
     public function one();




     /**
      * Fetch result as array
      *
      * @return mixed
     */
     public function assoc();




     /**
      * Fetch column
      *
      * @return mixed
     */
     public function column();




     /**
      * Fetch columns
      *
      * @return mixed
     */
     public function columns();




     /**
      * Fetch object
      *
      * @return mixed
     */
     public function object();
}