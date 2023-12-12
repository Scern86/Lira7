<?php

namespace Scern\Lira\Config;

interface Source
{
    public function getArray(): array;
}