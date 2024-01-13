<?php

namespace Scern\Lira\Component\Admin;

use Scern\Lira\Application\{Controller, Extensions};
use Scern\Lira\Application\Result\{Error, InternalRedirect, Json, Redirect, Result, Success};
use Scern\Lira\Config\{Config, PhpFile};
use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\{Access\AccessManager, Router, State\StateStrategy, View, User};
use \Scern\Lira\Extensions\Database\Adapters\Postgresql;
use Symfony\Component\HttpFoundation\Request;

class Admin extends Controller
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
        $rules = [
            'Scern\Lira\Component\Admin\Article\Article::_add'=>true,
            'Scern\Lira\Component\Admin\Article\Article::_edit'=>false,
            'Scern\Lira\Component\Admin\Article\Article::_list'=>true,
        ];
        $dbManager = $this->extensions->getDatabaseManager();
        $dbManager->set(
            'database',
            new Postgresql(...$this->config->get('database'))
        );
        $this->user = new \Scern\Lira\Component\Admin\User(new AccessManager($rules),$stateManager,$dbManager,$this->request->getClientIp());
        parent::__construct($stateManager,$config, $request, $view, $lexicon, $this->user, $extensions);
        $this->view->setTemplate(ROOT_DIR . DS . 'component' . DS . 'Admin' . DS . 'template.inc');
    }

    public function execute(string $url): Result
    {
        $url = str_replace('/admin','',$url);
        if(empty($url)) $url = '/';

        $router = new Router(
            \Scern\Lira\Component\DefaultController::class,
            (new PhpFile(ROOT_DIR . DS . 'component' . DS . 'Admin' . DS . 'routes.php'))->getArray()
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
                return new Success($this->view->render());
            case Json::class:
            case Redirect::class:
            case InternalRedirect::class:
                return $result;
            default:
                return new Error('Controller error');
        }
    }
}