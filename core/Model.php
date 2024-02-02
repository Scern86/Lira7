<?php

namespace Scern\Lira;

use Scern\Lira\Database\Database;

readonly class Model
{
    protected object $db;
    public function __construct(Database $database)
    {
        $this->db = $database->getDatabaseObject();
    }
}