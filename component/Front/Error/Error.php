<?php

namespace Scern\Lira\Component\Front\Error;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Results\Success;
use Scern\Lira\Component\Front\Page\PageData;
use Scern\Lira\Results\Result;
use Scern\Lira\View;
use Symfony\Component\HttpFoundation\Response;

class Error extends Controller
{
    const CONTROLLER_DIR = ROOT_DIR.DS.'component'.DS.'Front'.DS.'Error';

    public function execute(string $uri): Result
    {
        $view = new View($this->lexicon);
        $this->view->page = new PageData(meta_title:'Error page');
        return new \Scern\Lira\Application\Results\Error($view->render(self::CONTROLLER_DIR.DS.'template.inc'),Response::HTTP_NOT_FOUND);
    }
}