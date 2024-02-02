<?php

namespace Scern\Lira\Component\Front\Error;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Results\Success;
use Scern\Lira\Component\Front\Page\PageData;
use Scern\Lira\Results\Result;
use Scern\Lira\View;

class Error extends Controller
{
    public function execute(string $uri): Result
    {
        $view = new View($this->lexicon);
        $this->view->page = new PageData(meta_title:'Error page');
        return new Success($view->render(ROOT_DIR.DS.'component'.DS.'Front'.DS.'Error'.DS.'template.inc'));
    }
}