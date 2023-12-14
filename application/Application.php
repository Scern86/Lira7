<?php

namespace Scern\Lira\Application;

use Scern\Lira\Application\Result\{Error, InternalRedirect, Json, Redirect, Result, Success};
use Scern\Lira\Config\Config;
use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\Router;
use Scern\Lira\View;
use Symfony\Component\HttpFoundation\Request;

class Application
{
    const VERSION = '7.3.0';

    public function __construct(protected Config $config, protected Request $request, protected Router $router, protected View $view, protected Lexicon $lexicon, protected Extensions $extensions)
    {
    }

    public function execute(string $requestUri): Result
    {
        $controllerClass = $this->router->execute($requestUri);

        $controller = new $controllerClass($this->config, $this->request, $this->view, $this->lexicon, $this->extensions);

        $result = $controller->execute($requestUri);

        return match ($result::class) {
            Success::class, Error::class, Json::class, Redirect::class => $result,
            InternalRedirect::class => $this->execute($result->url),
            default => new Error('Application error')
        };
    }
}