<?php

namespace Scern\Lira\Application;

use Scern\Lira\Application\Result\Result;
use Scern\Lira\Config\Config;
use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\View;
use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{
    public function __construct(protected Config $config,protected Request $request,protected View $view,protected Lexicon $lexicon,protected Extensions $extensions)
    {
    }

    abstract public function execute(string $url): Result;
}