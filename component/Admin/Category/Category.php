<?php

namespace Scern\Lira\Component\Admin\Category;

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

class Category extends Controller
{
    const TEMPLATES_DIR = ROOT_DIR . DS . 'component' . DS . 'Admin' . DS . 'Category' . DS . 'templates';

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->model = new Model($this->extensions->getDatabaseManager()->get('database'));
    }

    public function execute(string $url): Result
    {
        if ($this->user->isGuest) return new Redirect($this->view->makeLink('/admin/login'));
        $url = str_replace('/category', '', $url);
        if (!empty($url)) {
            list($root, $action) = explode('/', $url);
            return match ($action) {
                'add' => $this->_add($url),
                'edit' => $this->_edit($url),
                'list' => $this->_list($url),
                default => new Error('Action not found'),
            };
        }
        return new Redirect($this->view->makeLink('/admin/category/list'));
    }

    protected function _add(string $url): Result
    {
        if (!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        if ($this->request->isMethod('POST')) {
            $title = trim(htmlspecialchars($this->request->get('title')));
            $category = $this->model->createCategory($title, $this->config->get('main')['languages_list']);
            if (!is_null($category)) return new Redirect($this->view->makeLink('/admin/category/edit/' . $category['id']));
            else return new Redirect($this->view->makeLink('/admin/category/add'));
        }
        $this->view->meta_title = 'Add category | SCERN';
        $view = new View($this->lexicon);
        return new Success($view->render(self::TEMPLATES_DIR . DS . 'add.inc'));
    }

    protected function _edit(string $url): Result
    {
        if (!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        try {
            if (preg_match('/\/edit\/(\d+)/', $url, $matches)) {
                $id = $matches[1];
                if ($this->request->isMethod('POST')) {
                    $created = trim(htmlspecialchars($this->request->get('created')));
                    $title = trim(htmlspecialchars($this->request->get('title')));
                    $this->model->updateCategory($id, $created, $this->lexicon->currentLang, $title);
                    return new Redirect($this->view->makeLink('/admin/category/edit/' . $id));
                }
                $this->view->meta_title = 'Edit category | Lira';
                $view = new View($this->lexicon);
                $view->category = $category = $this->model->getCategoryById($id, $this->lexicon->currentLang);
                if (empty($category)) throw new \Exception('Category not found');
                return new Success($view->render(self::TEMPLATES_DIR . DS . 'edit.inc'));
            } else throw new \Exception('ID undefined');
        } catch (\Exception $e) {
            return new Error('404 Not Found', 404);
        }
    }

    protected function _list(): Result
    {
        if (!$this->user->isMethodAllowed(__METHOD__)) return new Error('Access denied');
        $this->view->meta_title = 'List categories | SCERN';
        $view = new View($this->lexicon);
        $view->listCategories = $this->model->getCategoriesList();
        return new Success($view->render(self::TEMPLATES_DIR . DS . 'list.inc'));
    }
}