<?php

namespace Scern\Lira\Component\Admin\Article;

use Scern\Lira\Access\AccessManager;
use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{Error, Redirect, Result, Success};
use Scern\Lira\Application\Extensions;
use Scern\Lira\Application\Models\Role;
use Scern\Lira\Config\Config;
use Scern\Lira\Extensions\Database\Adapters\Postgresql;
use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\State\StateStrategy;
use Scern\Lira\User;
use Scern\Lira\View;
use Symfony\Component\HttpFoundation\Request;

class Article extends Controller
{
    const TEMPLATES_DIR = ROOT_DIR.DS.'component'.DS.'Admin'.DS.'Article'.DS.'templates';

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->model = new Model($this->extensions->getDatabaseManager()->get('database'));
    }

    public function execute(string $url): Result
    {
        if($this->user->isGuest) return new Redirect($this->view->makeLink('/admin/login'));
        $url = str_replace('/article','',$url);
        if(!empty($url)){
            list($root,$action) = explode('/',$url);
            return match ($action){
                'add'=>$this->_add($url),
                'edit'=>$this->_edit($url),
                'list'=>$this->_list($url),
                default=>new Error('Action not found'),
            };
        }
        return new Redirect($this->view->makeLink('/admin/article/list'));
    }

    protected function _add(string $url): Result
    {
        if(!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        if($this->request->isMethod('POST')){
            $title = trim(htmlspecialchars($this->request->get('title')));
            $content = $this->request->get('content');
            $article = $this->model->createArticle($title,$content,$this->config->get('main')['languages_list']);
            if(!is_null($article)) return new Redirect($this->view->makeLink('/admin/article/edit/'.$article['id']));
            else return new Redirect($this->view->makeLink('/admin/article/add'));
        }
        $this->view->addLinkToBodysEnd('<script defer src="https://cdn.ckeditor.com/ckeditor5/40.2.0/super-build/ckeditor.js"></script>');
        $this->view->addLinkToBodysEnd('<script defer src="/ck-config.js"></script>');
        $this->view->meta_title = 'Add Article | Lira';
        $view = new View($this->lexicon);
        return new Success($view->render(self::TEMPLATES_DIR.DS.'add.inc'));
    }
    protected function _edit(string $url): Result
    {
        if(!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        try{
            if (preg_match('/\/edit\/(\d+)/', $url, $matches)) {
                $id = $matches[1];
                if($this->request->isMethod('POST')){
                    $created = trim(htmlspecialchars($this->request->get('created')));
                    $title = trim(htmlspecialchars($this->request->get('title')));
                    $content = $this->request->get('content');
                    $this->model->updateArticle($id,$created,$this->lexicon->currentLang,$title,$content);
                    return new Redirect($this->view->makeLink('/admin/article/edit/'.$id));
                }
                $this->view->meta_title = 'Edit Article | Lira';
                $view = new View($this->lexicon);
                $view->article = $article = $this->model->getArticleById($id,$this->lexicon->currentLang);
                $this->view->addLinkToBodysEnd('<script defer src="https://cdn.ckeditor.com/ckeditor5/40.2.0/super-build/ckeditor.js"></script>');
                $this->view->addLinkToBodysEnd('<script defer src="/ck-config.js"></script>');
                if(empty($article)) throw new \Exception('Article not found');
                return new Success($view->render(self::TEMPLATES_DIR.DS.'edit.inc'));
            }
            else throw new \Exception('ID undefined');
        }catch (\Exception $e){
            return new Error('404 Not Found',404);
        }
    }

    protected function _list(): Result
    {
        if(!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        $this->view->meta_title = 'List Article | Lira';
        $view = new View($this->lexicon);
        $view->listArticles = $this->model->getArticlesList();
        return new Success($view->render(self::TEMPLATES_DIR.DS.'list.inc'));
    }
}