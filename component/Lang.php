<?php

namespace Scern\Lira\Component;

use Scern\Lira\Application\Controller;
use Scern\Lira\Application\Result\{InternalRedirect, Redirect, Result};

class Lang extends Controller
{
    public function execute(string $url): Result
    {
        $urlArray = array_filter(explode('/',$url));
        $lang = array_shift($urlArray);
        $url = str_replace(['/ru','/en','/gr','/es','/de'],'',$url);

        if($lang==$this->lexicon->defaultLang->code) return new Redirect($url);

        $this->lexicon->currentLang = new \Scern\Lira\Lexicon\Lang($lang);
        if(empty($url)) $url = '/';
        return new InternalRedirect($url);
    }
}