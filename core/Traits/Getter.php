<?php

namespace Scern\Lira\Traits;

trait Getter
{
    public function __get(string $key): mixed
    {
        return array_key_exists($key, $this->values) ? $this->values[$key] : null;
    }

    public function get(string $key, $default_value = null): mixed
    {
        return array_key_exists($key, $this->values) ? $this->values[$key] : $default_value;
    }

    public function __isset(string $key): bool
    {
        return isset($this->values[$key]);
    }
}