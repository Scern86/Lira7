<?php

namespace Scern\Lira\Application;

use Scern\Lira\Application\Result\Result;
use Scern\Lira\Config\Config;
use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\{State\StateManager, View, User};
use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{
    public function __construct(
        protected StateManager $stateManager,
        protected Config $config,
        protected Request $request,
        protected View $view,
        protected Lexicon $lexicon,
        protected User $user,
        protected Extensions $extensions
    )
    {
    }

    abstract public function execute(string $url): Result;
}