<?php

return [
    '#^/$#' => \Scern\Lira\Component\Front\Index::class,
    '#^/catalog($|/)#' => \Scern\Lira\Component\Front\Catalog::class,
    '#^/test($|/)#' => \Scern\Lira\Component\Front\Test::class,
    '#^/profile($|/)#' => \Scern\Lira\Component\Front\Profile\Profile::class,
];