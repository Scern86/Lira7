<?php

namespace Scern\Lira\Traits;

trait Setter
{
    protected readonly bool $appendOnly;

    public function __set(string $key, $value): void
    {
        if (!$this->appendOnly || !array_key_exists($key, $this->values)) $this->values[$key] = $value;
    }

    public function __unset(string $key): void
    {
        if (array_key_exists($key, $this->values) && !$this->appendOnly) unset($this->values[$key]);
    }
}