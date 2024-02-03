<?php

namespace Scern\Lira\Component\Front\Page;

use Scern\Lira\Lexicon\Lexicon;

readonly class PageData
{
    public function __construct(
        public int $id = 0,
        public string $uri = '',
        public string $language = '',
        public ?string $h1 = '',
        public ?string $meta_title = '',
        public ?string $meta_description = '',
        public bool $robots_index = false,
        public bool $robots_follow = false
    )
    {
    }

    public function render(Lexicon $lexicon): string
    {
        $index = $this->robots_index ? 'index' : 'noindex';
        $follow = $this->robots_follow ? 'follow' : 'nofollow';
        return <<<EOT
        <title>{$this->meta_title}</title>
        <meta name="description" content="{$this->meta_description}">
        <meta name="robots" content="{$index},{$follow}">
EOT;
    }
}