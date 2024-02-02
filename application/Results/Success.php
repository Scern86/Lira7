<?php

namespace Scern\Lira\Application\Results;

use Scern\Lira\Results\Result;
use Symfony\Component\HttpFoundation\Response;

readonly class Success extends Result
{
    public function __construct(public ?string $content = null, public int $statusCode = Response::HTTP_OK, public array $headers = [])
    {
    }
}