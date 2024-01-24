<?php

namespace Scern\Lira\Component\Front\Index;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{Result, Success};
use Scern\Lira\Component\Front\Models\Article;
use Scern\Lira\Extensions\Database\Adapters\Postgresql;
use Scern\Lira\View;

class Index extends Controller
{
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $db = new Postgresql(...$this->config->get('database'));
        $this->model = new Article($db->db);
    }
    public function execute(string $url): Result
    {
        $view = new View($this->lexicon);
        $view->article = $article = $this->model->getArticleById(4,$this->lexicon->currentLang);
        $this->view->meta_title = $article['title'].' | Lira';
        /*$this->lexicon->load(['en'=>[
            'home'=>'Home',
            'about'=>'About',
            'catalog'=>'Catalog',
        ]]);*/
        return new Success($view->render(ROOT_DIR . DS . 'component' . DS . 'Front' . DS . 'Index' . DS . 'template.inc'));
    }
}