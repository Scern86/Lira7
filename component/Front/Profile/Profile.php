<?php

namespace Scern\Lira\Component\Front\Profile;

use Scern\Lira\{Access\AccessManager, State\StateStrategy, User, View};
use Scern\Lira\Application\{Controller,Extensions};
use Scern\Lira\Application\Result\{Redirect, Result, Success};
use Scern\Lira\Config\Config;
use Scern\Lira\Lexicon\Lexicon;
use Symfony\Component\HttpFoundation\Request;

class Profile extends Controller
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
        $this->user = new \Scern\Lira\Component\Front\User(new AccessManager(), $stateManager);
        parent::__construct(
            $stateManager,
            $config,
            $request,
            $view,
            $lexicon,
            $this->user,
            $extensions
        );
    }

    public function execute(string $url): Result
    {
        $this->view->setTemplate(ROOT_DIR . DS . 'component' . DS . 'Front' . DS . 'template.inc');
        $url = str_replace('/profile', '', $url);
        switch ($url) {
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
        if (!$this->user->isGuest) {
            return new Redirect($this->view->makeLink('/profile'));
        } else {
            if ($this->request->isMethod('POST')) {
                $login = $this->request->get('login');
                $password = $this->request->get('password');
                if ($this->user->login($login, $password)) {
                    return new Redirect($this->view->makeLink('/profile'));
                }
            }
        }
        $view = new View($this->lexicon);
        $content = $view->render(ROOT_DIR . DS . 'component' . DS . 'Front' . DS . 'Profile' . DS . 'Templates' . DS . 'login.inc');
        return new Success($content);
    }

    protected function logout(): Result
    {
        $this->user->logout();
        return new Redirect($this->view->makeLink('/'));
    }

    public function index(): Result
    {
        if (!$this->user->isGuest) {
            $view = new View($this->lexicon);
            $content = $view->render(ROOT_DIR . DS . 'component' . DS . 'Front' . DS . 'Profile' . DS . 'Templates' . DS . 'profile.inc');
            return new Success($content);
        } else {
            return new Redirect($this->view->makeLink('/profile/login'));
        }
    }
}