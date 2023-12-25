<?php

namespace Scern\Lira\Extensions\Database\Adapters;

use Scern\Lira\Extensions\Database\Database;

readonly class Postgresql implements Database
{
    public ?\PDO $db;

    public function __construct(string $host,int $port,string $database,string $user,string $password)
    {
        try{
            $dsn = "pgsql:host={$host};port={$port};dbname={$database}";
            $this->db = new \PDO($dsn, $user, $password);
        }catch (\PDOException $e){
            var_dump($e);
            //EventDispatcher::event('needToLog',new \Exception("Database {$dbname} connect error",500));
            $this->db = null;
        }
    }
}