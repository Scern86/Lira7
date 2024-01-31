<?php

namespace Scern\Lira\Component\Admin\Page;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{Error, Redirect, Result, Success};
use Scern\Lira\View;

//use Scern\Lira\Application\Objects\Page;

class Page extends Controller
{
    const TEMPLATES_DIR = ROOT_DIR . DS . 'component' . DS . 'Admin' . DS . 'Page' . DS . 'templates';

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->model = new Model($this->extensions->getDatabaseManager()->get('database'));
    }

    public function execute(string $url): Result
    {
        if ($this->user->isGuest) return new Redirect($this->view->makeLink('/admin/login'));
        $url = str_replace('/page', '', $url);
        if (!empty($url)) {
            list($root, $action) = explode('/', $url);
            return match ($action) {
                'add' => $this->_add($url),
                'edit' => $this->_edit($url),
                'list' => $this->_list($url),
                default => new Error('Action not found'),
            };
        }
        return new Redirect($this->view->makeLink('/admin/page/list'));
    }

    protected function _add(string $url): Result
    {
        if (!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        if ($this->request->isMethod('POST')) {
            $uri = trim(htmlspecialchars($this->request->get('uri')));
            $h1 = trim(htmlspecialchars($this->request->get('h1')));
            $page = new \Scern\Lira\Application\Objects\Page();
            $page->uri = $uri;
            $page->h1 = $h1;
            $pageId = $this->model->createPage($page, $this->config->get('main')['languages_list']);
            if (!is_null($pageId)) return new Redirect($this->view->makeLink('/admin/page/edit/' . $pageId));
            else return new Redirect($this->view->makeLink('/admin/page/add'));
        }
        $this->view->seo->title = 'Add page | SCERN';
        $view = new View($this->lexicon);
        return new Success($view->render(self::TEMPLATES_DIR . DS . 'add.inc'));
    }

    protected function _edit(string $url): Result
    {
        if (!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        try {
            if (preg_match('/\/edit\/(\d+)/', $url, $matches)) {
                $id = $matches[1];
                $pageModel = new \Scern\Lira\Application\Models\Page($this->extensions->getDatabaseManager()->get('database'));
                $page = $pageModel->getById($id, $this->lexicon->currentLang);
                if ($this->request->isMethod('POST')) {
                    $page->uri = trim(htmlspecialchars($this->request->get('uri')));
                    $page->h1 = trim(htmlspecialchars($this->request->get('h1')));
                    $page->meta_title = trim(htmlspecialchars($this->request->get('meta_title')));
                    $page->meta_description = trim(htmlspecialchars($this->request->get('meta_description')));
                    $page->robots_index = $this->request->get('robots_index')==='true';
                    $page->robots_follow = $this->request->get('robots_follow')==='true';
                    $this->model->updatePage($page,$this->lexicon->currentLang);
                    return new Redirect($this->view->makeLink('/admin/page/edit/' . $id));
                }
                $this->view->seo->title = 'Edit page | SCERN';
                $view = new View($this->lexicon);
                $view->page = $page;
                if (empty($page)) throw new \Exception('Page not found');
                return new Success($view->render(self::TEMPLATES_DIR . DS . 'edit.inc'));
            } else throw new \Exception('ID undefined');
        } catch (\Exception $e) {
            return new Error('404 Not Found', 404);
        }
    }

    protected function _list(): Result
    {
        if (!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        $this->view->seo->title = 'List pages | SCERN';
        $view = new View($this->lexicon);
        $view->listPages = $this->model->getPagesList($this->lexicon->currentLang);
        return new Success($view->render(self::TEMPLATES_DIR . DS . 'list.inc'));
    }
}