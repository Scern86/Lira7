<?php

namespace Scern\Lira;

use Scern\Lira\Lexicon\Lexicon;

class Seo
{
    public string $title = '';
    public string $description = '';
    public string $keywords = '';
    public string $ogTitle = '';
    public string $ogDescription = '';
    public string $ogImage = '';
    public string $ogType = '';
    public string $ogLocale = '';

    public function __construct(protected Lexicon $lexicon)
    {
    }

    public function render(): string
    {
        return <<<EOT
        <title>{$this->title}</title>
        <meta name="description" content="{$this->description}">
        <meta name="keywords" content="{$this->keywords}">
EOT;
    }
}