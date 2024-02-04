<?php

return [
    '#^/$#' => \Scern\Lira\Component\Admin\Dashboard::class,
    '#^/page($|/)#' => \Scern\Lira\Component\Admin\Page\Page::class,
    '#^/(login|logout)$#'=>\Scern\Lira\Component\Admin\Auth\Auth::class,
];