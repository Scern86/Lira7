<?php

namespace Scern\Lira\Config;

use Scern\Lira\Traits\Getter;

class Source
{
    use Getter;

    public function __construct(public readonly array $values)
    {
    }
}