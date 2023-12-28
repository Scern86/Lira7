<?php

namespace Scern\Lira\Component\Front;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{Result, Success};

class Index extends Controller
{

    public function execute(string $url): Result
    {
        $this->view->meta_title = 'Home | Lira';
        //$this->lexicon->load(['ru'=>['test'=>'drive'],'es'=>['test'=>rand(100,999)]]);
        //$this->view->setTemplate(ROOT_DIR.DS.'component'.DS.'Front'.DS.'Templates'.DS.'default.inc');
        return new Success('Home page');
    }
}