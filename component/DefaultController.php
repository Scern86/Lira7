<?php

namespace Scern\Lira\Component;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{Result, Success};

class DefaultController extends Controller
{
    public function execute(string $url): Result
    {
        return new Success('Default');
    }
}