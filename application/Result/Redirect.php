<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

readonly class Redirect extends Result
{
    public function __construct(public string $url,public int $statusCode=Response::HTTP_MOVED_PERMANENTLY,public array $headers=[])
    {

    }
}