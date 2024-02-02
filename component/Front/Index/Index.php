<?php

namespace Scern\Lira\Component\Front\Index;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Results\Success;
use Scern\Lira\Component\Front\Article\ArticleModel;
use Scern\Lira\Component\Front\Page\PageModel;
use Scern\Lira\Results\Result;
use Scern\Lira\View;

class Index extends Controller
{
    public function execute(string $uri): Result
    {
        $pageModel = new PageModel($this->database->get('database'));
        $this->view->page = $page = $pageModel->getPageById(1,$this->lexicon->currentLang);
        $articleModel = new ArticleModel($this->database->get('database'));
        $article = $articleModel->getArticleById(1,$this->lexicon->currentLang);
        $view = new View($this->lexicon);
        $view->h1 = $page->h1;
        $view->article = $article;
        return new Success($view->render(ROOT_DIR.DS.'component'.DS.'Front'.DS.'Index'.DS.'template.inc'));
    }
}