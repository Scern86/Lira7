<?php

namespace Scern\Lira\Component\Front;

use Scern\Lira\{Router, State\StateStrategy, View, User};
use Scern\Lira\Application\{Controller, Extensions};
use Scern\Lira\Application\Result\{Error, InternalRedirect, Json, Redirect, Result, Success};
use Scern\Lira\Config\{Config, PhpFile};

class Front extends Controller
{
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->config->set('routes-front',new PhpFile(ROOT_DIR . DS . 'component' . DS . 'Front' . DS . 'routes.php'));
    }

    public function execute(string $url): Result
    {
        $this->view->addLinkToHeader('<link rel="stylesheet" href="/assets/css/style.min.css?'.time().'">');

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

        $this->lexicon->load([
            'en'=>[
            'home'=>'Home',
            'about'=>'About',
            'catalog'=>'Catalog',
                ],
            'ru'=>[
                'home'=>'Главная',
                'about'=>'Обо мне',
                'catalog'=>'Каталог',
            ],
        ]);

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