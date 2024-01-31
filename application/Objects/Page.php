<?php

namespace Scern\Lira\Application\Objects;

class Page
{
    public int $id = 0;
    public int $id_page = 0;

    public ?string $uri = '';

    public string $language = '';

    public ?string $h1 = '';

    public ?string $meta_title = '';

    public ?string $meta_description = '';

    public bool $robots_index = false;
    public bool $robots_follow = false;
}