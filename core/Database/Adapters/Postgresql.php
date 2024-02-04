<?php

namespace Scern\Lira\Database\Adapters;

use Scern\Lira\Config\Source;
use Scern\Lira\Database\Database;

readonly class Postgresql implements Database
{
    protected ?\PDO $db;

    public function __construct(Source $params)
    {
        try{
            $dsn = "pgsql:host={$params->host};port={$params->port};dbname={$params->database}";
            $this->db = new \PDO($dsn, $params->user, $params->password);
        }catch (\PDOException $e){
            //var_dump($e);
            //TODO log
            //throw new \Exception('No connection to database');
            $this->db = null;
        }
    }

    public function getDatabaseObject(): ?object
    {
        return $this->db;
    }
}