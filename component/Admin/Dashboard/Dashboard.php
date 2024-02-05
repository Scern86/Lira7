<?php

namespace Scern\Lira\Component\Admin\Dashboard;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Results\{Error, Redirect, Success};
use Scern\Lira\Results\Result;
use Scern\Lira\View;
use Symfony\Component\HttpFoundation\Response;

class Dashboard extends Controller
{
    const CONTROLLER_DIR = ROOT_DIR . DS . 'component' . DS . 'Admin'.DS.'Dashboard';

    public function execute(string $uri): Result
    {
        if(!$this->user->isLoggedIn()) return new Redirect($this->view->makeLink('/admin/login'));
        if(!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied',Response::HTTP_FORBIDDEN);
        $view = new View($this->lexicon);
        return new Success($view->render(self::CONTROLLER_DIR.DS.'template.inc'));
    }
}