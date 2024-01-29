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
        $dbManager = $this->extensions->getDatabaseManager();
        $dbManager->set(
            'database',
            new Postgresql(...$this->config->get('database'))
        );
        $this->user = new \Scern\Lira\Component\Admin\User(new AccessManager(),$stateManager,$dbManager,$this->request->getClientIp());
        parent::__construct($stateManager,$config, $request, $view, $lexicon, $this->user, $extensions);
        /*$this->view->setTemplate(ROOT_DIR . DS . 'component' . DS . 'Admin' . DS . 'template.inc');*/
        $this->view->seo->base = $this->config->get('main')['domain'];
        $this->view->addLinkToHeader('<link rel="stylesheet" href="/assets/css/style.min.css?'.time().'">');
        $this->view->addLinkToBodysEnd('<script defer src="https://code.jquery.com/jquery-3.7.1.min.js" 
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>');
        $this->view->addLinkToBodysEnd('<script type="module" src="/assets/js/script.min.js?'.time().'"></script>');
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

        $this->lexicon->load([
            'en'=>[
                'home'=>'Home',
                'about'=>'About',
                'blog'=>'Blog',
                'projects'=>'Projects',
                'contacts'=>'Contacts',
                'email'=>'E-mail',
                'phone'=>'Phone',
                'catalog'=>'Catalog',
                'coming_soon'=>'Coming soon',
            ],
            'ru'=>[
                'home'=>'Главная',
                'about'=>'Обо мне',
                'blog'=>'Блог',
                'projects'=>'Проекты',
                'contacts'=>'Контакты',
                'email'=>'E-mail',
                'phone'=>'Телефон',
                'catalog'=>'Каталог',
                'coming_soon'=>'Coming soon',
            ],
            'de'=>[
                'home'=>'DE-Home',
                'about'=>'DE-About',
                'blog'=>'Blog',
                'projects'=>'Projects',
                'contacts'=>'Contacts',
                'email'=>'E-mail',
                'phone'=>'Phone',
                'catalog'=>'DE-Catalog',
                'coming_soon'=>'Coming soon',
            ],
            'es'=>[
                'home'=>'ES-Home',
                'about'=>'ES-About',
                'blog'=>'Blog',
                'projects'=>'Projects',
                'contacts'=>'Contacts',
                'email'=>'E-mail',
                'phone'=>'Phone',
                'catalog'=>'ES-Catalog',
                'coming_soon'=>'Coming soon',
            ],
            'gr'=>[
                'home'=>'GR-Home',
                'about'=>'GR-About',
                'blog'=>'Blog',
                'projects'=>'Projects',
                'contacts'=>'Contacts',
                'email'=>'E-mail',
                'phone'=>'Phone',
                'catalog'=>'GR-Catalog',
                'coming_soon'=>'Coming soon',
            ],
        ]);

        $result = $controller->execute($url);

        switch ($result::class) {
            case Success::class:
            case Error::class:
                $this->view->content = $result->content;
                return new Success($this->view->render(ROOT_DIR . DS . 'component' . DS . 'Admin' . DS . 'templates' . DS . 'template.inc'));
            case Json::class:
            case Redirect::class:
            case InternalRedirect::class:
                return $result;
            default:
                return new Error('Controller error');
        }
    }
}