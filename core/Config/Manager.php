<?php

namespace Scern\Lira\Config;

use Scern\Lira\Traits\Getter;

class Manager
{
    use Getter;
    protected array $values = [];
    public function set(string $key,Source $source): void
    {
        if(!array_key_exists($key,$this->values)) $this->values[$key] = $source;
    }
}