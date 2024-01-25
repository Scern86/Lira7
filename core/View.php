<?php

namespace Scern\Lira;

use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\Traits\{Getter, Setter};

class View
{
    use Getter,Setter;

    private array $values = [];

    private array $headersLinks = [];
    private array $bodysLinks = [];

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

    public function makeLink(string $url): string
    {
        $lang = $this->lexicon->currentLang->code==$this->lexicon->defaultLang->code ? '' : $this->lexicon->currentLang->code;
        if(!empty($lang)){
            if($url=='/') $url = '/'.$lang;
            else $url = '/'.$lang.$url;
        }
        return $url;
    }

    public function addLinkToHeader(string $link,string $position='last'): void
    {
        if(!in_array($link,$this->headersLinks)) {
            if($position=='first') array_unshift($this->headersLinks,$link);
            else array_push($this->headersLinks,$link);
        }
    }
    public function addLinkToBodysEnd(string $link,string $position='last'): void
    {
        if(!in_array($link,$this->bodysLinks)) {
            if($position=='first') array_unshift($this->bodysLinks,$link);
            else array_push($this->bodysLinks,$link);
        }
    }
}