<?php

namespace Scern\Lira\Lexicon;

use Scern\Lira\Lexicon\Lang;

class Lexicon
{
    public Lang $currentLang;

    public function __construct(public readonly Lang $defaultLang, protected array $lexicon=[])
    {
        $this->currentLang = $this->defaultLang;
    }

    public function get(string $key, string $defaultValue, ?string $langCode = null): string
    {
        if (is_null($langCode)) $langCode = $this->currentLang->code;
        return $this->lexicon[$langCode][$key] ?? $defaultValue;
    }

    public function load(array $lexicon): void
    {
        $this->lexicon = array_merge($this->lexicon,$lexicon);
    }

    /*public function makeLangUrl(string $url): string
    {
        return '/'.ltrim($this->currentLang->code==$this->defaultLang->code ? $url : '/'.$this->currentLang->code.$url,'/');
    }*/
}