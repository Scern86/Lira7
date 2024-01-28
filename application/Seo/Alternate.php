<?php

namespace Scern\Lira\Application\Seo;

use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\View;

class Alternate
{
    public function __construct(protected string $canonical,protected Lexicon $lexicon)
    {
    }

    public function render(): string
    {
        $view = new View($this->lexicon);
        return <<<EOT
<link rel="canonical" href="{$view->makeLink($this->canonical)}">
<link rel="alternate" href="{$this->canonical}" hreflang="x-default">
EOT;
    }
}