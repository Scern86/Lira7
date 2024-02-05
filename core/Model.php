<?php

namespace Scern\Lira;

use Scern\Lira\Database\Database;

class Model
{
    protected ?object $db;
    public function __construct(protected Database $database)
    {
        $this->db = $database?->getDatabaseObject();
    }
}