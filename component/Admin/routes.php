<?php

return [
    '#^/$#'=>\Scern\Lira\Component\Admin\Dashboard\Dashboard::class,
    '#^/(login|logout)$#'=>\Scern\Lira\Component\Admin\Auth\Auth::class,
    '#^/article($|/)#'=>\Scern\Lira\Component\Admin\Article\Article::class,
    '#^/category($|/)#'=>\Scern\Lira\Component\Admin\Category\Category::class,
];