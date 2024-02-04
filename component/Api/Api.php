<?php

namespace Scern\Lira\Component\Api;

use Scern\Lira\Results\Result;
use Scern\Lira\Application\Results\Json;
use Scern\Lira\Application\Controller;
use Symfony\Component\HttpFoundation\Response;

class Api extends Controller
{
    public function execute(string $uri): Result
    {
        $data = ['result'=>true,'timestamp'=>time()];
        return new Json($data,Response::HTTP_CREATED);
    }
}