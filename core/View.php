<?php

namespace Scern\Lira;

use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\Traits\{Getter, Setter};

class View
{
    use Getter,Setter;

    private array $values = [];

    public function __construct(protected Lexicon $lexicon)
    {
        $this->appendOnly = false;
    }

    public function render(string $template): string
    {
        if(!file_exists($template)) throw new \Exception('File not exists');
        ob_start();
        include $template;
        $result = ob_get_clean();
        return $result;
    }
}