<?php

namespace Scern\Lira\Component\Front;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{Result, Success};

class Catalog extends Controller
{
    public function execute(string $url): Result
    {
        list($root,$action) = explode('/',$url);
        return match ($action){
            'show'=>$this->show($url),
            default=>$this->index($url),
        };
    }

    private function show($url): Result
    {
        $this->view->meta_title = 'Show catalog | Lira';
        return new Success('Show catalog item');
    }
    private function index($url): Result
    {
        $this->view->meta_title = 'List catalog | Lira';
        return new Success('LIST CATALOG');
    }
}