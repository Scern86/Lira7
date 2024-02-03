<?php

namespace Scern\Lira\Component\Front\Article;

readonly class ArticleData
{
    public function __construct(
        public int $id = 0,
        public string $created = '',
        public string $language = '',
        public ?string $title = '',
        public ?string $content = '',
    )
    {
    }
}