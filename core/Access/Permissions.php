<?php

namespace Scern\Lira\Access;

interface Permissions
{
    public function isMethodAllowed(string $method): bool;
}