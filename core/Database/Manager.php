<?php

namespace Scern\Lira\Database;

class Manager
{
    protected array $databases = [];

    public function get(string $key): ?object
    {
        return array_key_exists($key,$this->databases) ? $this->databases[$key] : null;
    }

    public function set(string $key, Database $database): void
    {
        if(!array_key_exists($key,$this->databases)) $this->databases[$key] = $database;
    }
}