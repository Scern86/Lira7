<?php

namespace Scern\Lira\Component\Front;

use Scern\Lira\Component\Front\Page\PageData;
use Scern\Lira\Lexicon\Lexicon;

class View extends \Scern\Lira\View
{
    public function __construct(Lexicon $lexicon,public PageData $page)
    {
        parent::__construct($lexicon);
    }
}