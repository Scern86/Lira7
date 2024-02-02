<?php

namespace Scern\Lira\Component\Front\TestRedirect;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Results\Success;
use Scern\Lira\Results\Result;
use Scern\Lira\View;

class TestRedirect extends Controller
{
    public function execute(string $uri): Result
    {
        $view = new View($this->lexicon);
        return new Success($view->render(ROOT_DIR.DS.'component'.DS.'Front'.DS.'TestRedirect'.DS.'template.inc'));
    }
}