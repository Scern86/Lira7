<?php

namespace Scern\Lira\Component\Api;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{Json, Result};

class Api extends Controller
{

    public function execute(string $url): Result
    {
        return new Json(['result'=>'success']);
    }
}