<?php

namespace Scern\Lira\Component\Admin\Auth;

use Scern\Lira\Application\{Controller, Extensions};
use Scern\Lira\Application\Result\{Error, InternalRedirect, Json, Redirect, Result, Success};
use Scern\Lira\Config\{Config};
use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\{State\StateStrategy, View, User};
use Symfony\Component\HttpFoundation\Request;

class Auth extends Controller
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
        $this->view->setTemplate(ROOT_DIR . DS . 'component' . DS . 'Admin' . DS . 'Auth' . DS . 'login.inc');
    }

    public function execute(string $url): Result
    {
        list($root,$action) = explode('/',$url);
        switch ($action){
            case 'login':
                return $this->login();
            case 'logout':
                return $this->logout();
            default:
                return new Success('Auth default action');
        }
    }

    protected function login(): Result
    {
        if(!$this->user->isGuest) return new Redirect('/admin');
        if($this->request->isMethod('POST')){
            $login = $this->request->get('login');
            $password = $this->request->get('password');
            if($this->user->login($login,$password)){
                return new Redirect($this->view->makeLink('/admin'));
            }
        }
        return new Success('Login');
    }
    protected function logout(): Result
    {
        if($this->user->isGuest) return new Redirect($this->view->makeLink('/admin/login'));
        $this->user->logout();
        return new Redirect($this->view->makeLink('/'));
    }
}