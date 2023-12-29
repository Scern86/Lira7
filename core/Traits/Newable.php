<?php

namespace Scern\Lira\Traits;

trait Newable
{
    public static function new(...$params): static
    {
        return new static(...$params);
    }
}