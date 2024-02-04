<?php

namespace Scern\Lira\Component;

use Scern\Lira\Application\Controller;
use Scern\Lira\Results\Result;
use Scern\Lira\Application\Results\Error;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function execute(string $uri): Result
    {
        return new Error('404 Not found',Response::HTTP_NOT_FOUND);
    }
}