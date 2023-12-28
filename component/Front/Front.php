<?php

namespace Scern\Lira\Component\Front;

use Scern\Lira\{Router, State\StateStrategy, View, User};
use Scern\Lira\Application\{Controller, Extensions};
use Scern\Lira\Application\Result\{Error, InternalRedirect, Json, Redirect, Result, Success};
use Scern\Lira\Config\{Config, PhpFile};
use Scern\Lira\Lexicon\Lexicon;
use Symfony\Component\HttpFoundation\Request;

class Front extends Controller
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
        parent::__construct(
            $stateManager,
            $config,
            $request,
            $view,
            $lexicon,
            $user,
            $extensions
        );
        $this->config->set('routes-front',new PhpFile(ROOT_DIR . DS . 'component' . DS . 'Front' . DS . 'routes.php'));
    }

    public function execute(string $url): Result
    {
        $router = new Router(
            \Scern\Lira\Component\DefaultController::class,
            $this->config->get('routes-front')
        );

        $controllerClass = $router->execute($url);

        $controller = new $controllerClass(
            $this->stateManager,
            $this->config,
            $this->request,
            $this->view,
            $this->lexicon,
            $this->user,
            $this->extensions
        );

        $result = $controller->execute($url);

        switch ($result::class) {
            case Success::class:
            case Error::class:
                $this->view->content = $result->content;
                return new Success($this->view->render(ROOT_DIR . DS . 'component' . DS . 'Front' . DS . 'template.inc'));
            case Json::class:
            case Redirect::class:
            case InternalRedirect::class:
                return $result;
            default:
                return new Error('Controller error');
        }
    }
}