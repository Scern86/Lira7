<?php

namespace Scern\Lira\Application;

use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\Application\Results\{Success, Error, Json, Redirect, InternalRedirect};
use Scern\Lira\Config\Manager;
use Scern\Lira\Results\Result;
use Scern\Lira\Router;
use Scern\Lira\Session;
use Scern\Lira\View;
use \Scern\Lira\Access\UserContract;
use Symfony\Component\HttpFoundation\{Request,Response};

class Application extends \Scern\Lira\Application\Controller
{
    const VERSION = '7.3.0';

    public function __construct(
        Request                         $request,
        Session                         $session,
        Manager                         $config,
        protected Router                $router,
        View                            $view,
        UserContract $user,
        Lexicon                         $lexicon,
        \Scern\Lira\Database\Manager    $database,
        \Scern\Lira\Cache\Manager       $cache,
        \Scern\Lira\Logger\Manager      $logger
    )
    {
        parent::__construct($request, $session, $config, $view, $user, $lexicon, $database, $cache, $logger);
    }

    public function execute(string $uri): Result
    {
        try {
            $componentClass = $this->router->execute($uri);

            $component = new $componentClass(
                $this->request,
                $this->session,
                $this->config,
                $this->view,
                $this->user,
                $this->lexicon,
                $this->database,
                $this->cache,
                $this->logger
            );

            $result = $component->execute($uri);

            return match ($result::class) {
                Success::class, Error::class, Json::class, Redirect::class => $result,
                InternalRedirect::class => $this->execute($result->url),
                default => new \Exception('Application error')
            };
        } catch (\Exception $e) {
            return new Error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}