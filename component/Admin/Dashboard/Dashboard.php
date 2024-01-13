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
    public function __construct(
        protected StateStrategy $stateManager,
        protected Config        $config,
        protected Request       $request,
        protected View          $view,
        protected Lexicon       $lexicon,
        protected User          $user,
        protected Extensions    $extensions
    )
    {
        parent::__construct($stateManager,$config, $request, $view, $lexicon, $user, $extensions);
    }

    public function execute(string $url): Result
    {
        if($this->user->isGuest) return new Redirect($this->view->makeLink('/admin/login'));
        return new Success();
    }
}