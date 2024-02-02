<?php

namespace Scern\Lira\Component\Front\Json;

use Scern\Lira\Application\Controller;
use Scern\Lira\Results\Result;

class Json extends Controller
{
    public function execute(string $uri): Result
    {
        $data = ['result'=>true,'timestamp'=>time()];
        return new \Scern\Lira\Application\Results\Json($data);
    }
}