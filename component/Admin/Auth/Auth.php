<?php

namespace Scern\Lira\Component\Admin\Auth;

use Scern\Lira\Application\Controller;
use Scern\Lira\View;
use Scern\Lira\Application\Results\{Redirect, Success};
use Scern\Lira\Results\Result;

class Auth extends Controller
{
    const CONTROLLER_DIR = ROOT_DIR.DS.'component'.DS.'Admin'.DS.'Auth';

    public function execute(string $uri): Result
    {
        list($root,$action) = explode('/',$uri);
        switch ($action){
            case 'login':
                return $this->login();
            case 'logout':
                return $this->logout();
            default:
                throw new \Exception('Auth default action');
        }
    }

    protected function login(): Result
    {
        if($this->user->isLoggedIn()) return new Redirect($this->view->makeLink('/admin'));
        if($this->request->isMethod('POST')){
            $login = $this->request->get('login');
            $password = $this->request->get('password');
            if($this->user->login($login,$password)){
                return new Redirect($this->view->makeLink('/admin'));
            }
        }
        $view = new View($this->lexicon);
        return new Success($view->render(self::CONTROLLER_DIR.DS.'login.inc'));
    }
    protected function logout(): Result
    {
        if($this->user->isLoggedIn()) $this->user->logout();
        return new Redirect($this->view->makeLink('/admin/login'));
    }
}