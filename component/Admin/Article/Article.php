<?php

namespace Scern\Lira\Component\Admin\Article;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{Error, Redirect, Result, Success};
use Scern\Lira\Application\Models\Role;
use Scern\Lira\View;

class Article extends Controller
{
    const TEMPLATES_DIR = ROOT_DIR.DS.'component'.DS.'Admin'.DS.'Article'.DS.'templates';

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
        $this->view->meta_title = 'Add Article | Lira';
        $view = new View($this->lexicon);
        return new Success($view->render(self::TEMPLATES_DIR.DS.'add.inc'));
    }
    protected function _edit(string $url): Result
    {
        if(!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        $this->view->meta_title = 'Edit Article | Lira';
        $view = new View($this->lexicon);
        return new Success($view->render(self::TEMPLATES_DIR.DS.'edit.inc'));
    }
    protected function _list(): Result
    {
        if(!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        $this->view->meta_title = 'List Article | Lira';
        $view = new View($this->lexicon);
        return new Success($view->render(self::TEMPLATES_DIR.DS.'list.inc'));
    }
}