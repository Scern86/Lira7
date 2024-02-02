<?php

namespace Scern\Lira;

use Scern\Lira\Results\Result;

abstract class Controller
{
    abstract public function execute(string $uri): Result;
}