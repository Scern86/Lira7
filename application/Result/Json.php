<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

readonly class Json extends Result
{
    public function __construct(public array $data=[],public int $statusCode=Response::HTTP_OK,public array $headers=[])
    {

    }
}