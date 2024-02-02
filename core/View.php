<?php

namespace Scern\Lira;

use Scern\Lira\Lexicon\Lexicon;
use Scern\Lira\Traits\{Getter, Setter};

class View
{
    use Getter,Setter;

    private array $values = [];

    protected ?string $template = null;

    protected array $headersLinks = [];

    protected array $bodysLinks = [];

    public function __construct(protected Lexicon $lexicon,bool $appendOnly=false)
    {
        $this->appendOnly = $appendOnly;
    }

    public function setTemplate(string $templatePath): void
    {
        if(!file_exists($templatePath)) throw new \Exception('File not exists');
        $this->template = $templatePath;
    }

    public function render(?string $templatePath=null): string
    {
        if(is_null($templatePath)) $templatePath = $this->template;
        if(is_null($templatePath))  throw new \Exception('Template not set');
        if(!file_exists($templatePath)) throw new \Exception('File not exists');
        ob_start();
        include $templatePath;
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