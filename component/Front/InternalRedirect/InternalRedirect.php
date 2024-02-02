<?php

namespace Scern\Lira\Component\Front\InternalRedirect;

use Scern\Lira\Application\Controller;
use Scern\Lira\Results\Result;

class InternalRedirect extends Controller
{
    public function execute(string $uri): Result
    {
        return new \Scern\Lira\Application\Results\InternalRedirect($this->view->makeLink('/page/redirected/here'));
    }
}