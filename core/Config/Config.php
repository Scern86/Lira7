<?php

namespace Scern\Lira\Config;

use Scern\Lira\Traits\Getter;
class Config
{
    use Getter;

    protected array $values = [];

    public function set(string $key,Source $source): void
    {
        $data = $source->getArray();
        if(!array_key_exists($key,$this->values)) $this->values[$key] = $data;
    }
}