<?php

namespace Scern\Lira\Component\Front\Redirect;

use Scern\Lira\Application\Controller;
use Scern\Lira\Results\Result;
use Symfony\Component\HttpFoundation\Response;

class Redirect extends Controller
{
    public function execute(string $uri): Result
    {
        return new \Scern\Lira\Application\Results\Redirect($this->view->makeLink('/page/redirected/here'),Response::HTTP_TEMPORARY_REDIRECT);
    }
}