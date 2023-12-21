<?php

namespace Scern\Lira;

readonly class User
{
    public function __construct(public bool $isGuest=true)
    {
    }

    public function isMethodAllowed(string $method): bool
    {
        return false;
    }
}