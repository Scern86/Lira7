<?php

namespace Scern\Lira\Application\Result;

use Symfony\Component\HttpFoundation\Response;

readonly class InternalRedirect extends Result
{
    public function __construct(public string $url)
    {

    }
}