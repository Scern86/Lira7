<?php

namespace Scern\Lira\Application;

use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\{Model, Session, View};
use \Scern\Lira\Access\UserContract;
use Symfony\Component\HttpFoundation\Request;

abstract class Controller extends \Scern\Lira\Controller
{
    protected Model $model;

    public function __construct(
        protected Request                         $request,
        protected Session                         $session,
        protected \Scern\Lira\Config\Manager      $config,
        protected View                            $view,
        protected UserContract $user,
        protected Lexicon                         $lexicon,
        protected \Scern\Lira\Database\Manager    $database,
        protected \Scern\Lira\Cache\Manager       $cache,
        protected \Scern\Lira\Logger\Manager      $logger
    )
    {
    }
}