<?php

namespace Scern\Lira;

abstract readonly class User
{
    public function __construct(public bool $isGuest=true)
    {
    }
}