<?php

namespace Scern\Lira\Lexicon;

readonly class Lang
{
    public function __construct(public ?string $code = null)
    {
        if(is_null($this->code)) throw new \Exception('Language string must set');
    }
}