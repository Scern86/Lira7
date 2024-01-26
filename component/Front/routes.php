<?php

return [
    '#^/$#' => \Scern\Lira\Component\Front\Index\Index::class,
    '#^/catalog($|/)#' => \Scern\Lira\Component\Front\Catalog::class,
    '#^/about($|/)#' => \Scern\Lira\Component\Front\About\About::class,
    '#^/test($|/)#' => \Scern\Lira\Component\Front\Test::class,
    '#^/profile($|/)#' => \Scern\Lira\Component\Front\Profile\Profile::class,
    '#^/blog($|/)#' => \Scern\Lira\Component\Front\Blog\Blog::class,
    '#^/projects($|/)#' => \Scern\Lira\Component\Front\Projects\Projects::class,
    '#^/contacts($|/)#' => \Scern\Lira\Component\Front\Contacts\Contacts::class,
];