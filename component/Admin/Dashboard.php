<?php

namespace Scern\Lira\Component\Admin;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Results\{Redirect,Success};
use Scern\Lira\Results\Result;

class Dashboard extends Controller
{
    public function execute(string $uri): Result
    {
        if(!$this->user->isLoggedIn()) return new Redirect($this->view->makeLink('/admin/login'));
        return new Success('Dashboard');
    }
}