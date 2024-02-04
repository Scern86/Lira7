<?php

namespace Scern\Lira\Component\Front\TestRedirect;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Results\Success;
use Scern\Lira\Results\Result;
use Scern\Lira\View;

class TestRedirect extends Controller
{
    const CONTROLLER_DIR = ROOT_DIR.DS.'component'.DS.'Front'.DS.'TestRedirect';
    public function execute(string $uri): Result
    {
        $view = new View($this->lexicon);
        return new Success($view->render(self::CONTROLLER_DIR.DS.'template.inc'));
    }
}