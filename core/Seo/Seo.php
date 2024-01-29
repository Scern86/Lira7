<?php

namespace Scern\Lira\Seo;

use Scern\Lira\Lexicon\Lexicon;

class Seo
{
    public string $base = '';
    public string $title = '';
    public string $description = '';
    public string $keywords = '';
    public string $ogTitle = '';
    public string $ogDescription = '';
    public string $ogImage = '';
    public string $ogType = '';
    public string $ogLocale = '';

    public string $canonical = '';

    protected Alternate $alternate;

    public function __construct(protected Lexicon $lexicon, public Robots $robots)
    {
    }

    public function render(): string
    {
        $this->alternate = new Alternate($this->canonical,$this->lexicon);
        return <<<EOT
        <base href="{$this->base}">
        <title>{$this->title}</title>
        <meta name="description" content="{$this->description}">
        <meta name="keywords" content="{$this->keywords}">
        {$this->robots->render()}
        {$this->alternate->render($this->base)}
EOT;
    }
}