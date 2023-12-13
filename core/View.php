<?php

namespace Scern\Lira;

use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\Traits\{Getter, Setter};

class View
{
    use Getter,Setter;

    private array $values = [];

    protected ?string $template = null;

    public function __construct(protected Lexicon $lexicon)
    {
        $this->appendOnly = false;
    }

    public function setTemplate(string $template): void
    {
        if(!file_exists($template)) throw new \Exception('File not exists');
        $this->template = $template;
    }

    public function render(?string $template=null): string
    {
        if(is_null($template) && !is_null($this->template)) $template = $this->template;
        if(is_null($template))  throw new \Exception('Template not set');
        if(!file_exists($template)) throw new \Exception('File not exists');
        ob_start();
        include $template;
        $result = ob_get_clean();
        return $result;
    }
}