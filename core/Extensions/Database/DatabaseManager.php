<?php

namespace Scern\Lira\Extensions\Database;

class DatabaseManager
{
    protected array $databases = [];

    public function get(string $key): mixed
    {
        return array_key_exists($key, $this->databases) ? $this->databases[$key]->db : null;
    }

    public function set(string $key, \Scern\Lira\Extensions\Database\Database $database): void
    {
        if (!array_key_exists($key, $this->databases)) $this->databases[$key] = $database;
    }
}