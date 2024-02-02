<?php

namespace Scern\Lira\Component;

use Scern\Lira\Results\Result;
use Scern\Lira\Application\Results\{InternalRedirect, Redirect, Success};
use Scern\Lira\Application\Controller;

class Lang extends Controller
{
    public function execute(string $uri): Result
    {
        $urlArray = array_filter(explode('/',$uri));
        $lang = array_shift($urlArray);
        $uri = str_replace(['/ru','/en','/gr','/es','/de'],'',$uri);

        if($lang==$this->lexicon->defaultLang->code) return new Redirect($uri);

        $this->lexicon->currentLang = new \Scern\Lira\Lexicon\Lang($lang);
        if(empty($uri)) $uri = '/';
        return new InternalRedirect($uri);
    }
}