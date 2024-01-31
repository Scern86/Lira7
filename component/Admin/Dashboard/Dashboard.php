<?php

namespace Scern\Lira\Component\Admin\Dashboard;

use Scern\Lira\Application\{Controller, Extensions};
use Scern\Lira\Application\Result\{Error, InternalRedirect, Json, Redirect, Result, Success};
use Scern\Lira\Config\{Config};
use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\{State\StateStrategy, View, User};
use Symfony\Component\HttpFoundation\Request;

class Dashboard extends Controller
{
    public function execute(string $url): Result
    {
        if($this->user->isGuest) return new Redirect($this->view->makeLink('/admin/login'));
        $this->view->seo->title = 'Dashboard | SCERN';
        return new Success();
    }
}