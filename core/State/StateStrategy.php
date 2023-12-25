<?php

namespace Scern\Lira\State;

interface StateStrategy
{
    public function init(): void;

    public function save(string $key,mixed $value): void;

    public function clear(): void;
}