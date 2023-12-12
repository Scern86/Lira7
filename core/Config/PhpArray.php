<?php

namespace Scern\Lira\Config;

class PhpArray implements Source
{
    public function __construct(protected array $config)
    {
    }

    public function getArray(): array
    {
        return $this->config;
    }
}