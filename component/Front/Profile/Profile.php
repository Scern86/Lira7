<?php

namespace Scern\Lira\Component\Front\Profile;

use Scern\Lira\Access\UserContract;
use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Results\Redirect;
use Scern\Lira\Application\Results\Success;
use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\Results\Result;
use Scern\Lira\Session;
use Scern\Lira\View;
use Symfony\Component\HttpFoundation\Request;

class Profile extends Controller
{

    public function __construct(
        Request                      $request,
        Session                      $session,
        \Scern\Lira\Config\Manager   $config,
        View                         $view,
        UserContract                 $user,
        Lexicon                      $lexicon,
        \Scern\Lira\Database\Manager $database,
        \Scern\Lira\Cache\Manager    $cache,
        \Scern\Lira\Logger\Manager   $logger
    )
    {
        $session->init();
        $user = new \Scern\Lira\Component\Front\Access\User(
            $database->get('database'),
            $session->session_id,
            $request->getClientIp(),
            'Front'
        );
        parent::__construct($request,$session,$config,$view,$user,$lexicon,$database,$cache,$logger);
    }

    public function execute(string $uri): Result
    {
        $uri = str_replace('/profile', '', $uri);
        switch ($uri) {
            case '/login':
                return $this->login();
            case '/logout':
                return $this->logout();
            default:
                return $this->index();
        }
    }

    protected function login(): Result
    {
        if($this->user->isLoggedIn()) return new Redirect($this->view->makeLink('/profile'));

        if($this->request->isMethod('POST')){
            $login = $this->request->get('login');
            $password = $this->request->get('password');
            if($this->user->login($login,$password)){
                return new Redirect($this->view->makeLink('/profile'));
            }
        }

        $view = new View($this->lexicon);
        return new Success($view->render(ROOT_DIR.DS.'component'.DS.'Front'.DS.'Profile'.DS.'templates'.DS.'guest.inc'));
    }
    protected function logout(): Result
    {
        if($this->user->isLoggedIn()) $this->user->logout();
        return new Redirect($this->view->makeLink('/profile/login'));
    }
    protected function index(): Result
    {
        $view = new View($this->lexicon);
        if(!$this->user->isLoggedIn()) return new Redirect($this->view->makeLink('/profile/login'));
        return new Success($view->render(ROOT_DIR.DS.'component'.DS.'Front'.DS.'Profile'.DS.'templates'.DS.'user.inc'));
    }
}