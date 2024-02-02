<?php

return [
    '#^/$#' => \Scern\Lira\Component\Front\Index\Index::class,
    '#^/error($|/)#' => \Scern\Lira\Component\Front\Error\Error::class,
    '#^/redirect($|/)#' => \Scern\Lira\Component\Front\Redirect\Redirect::class,
    '#^/internal($|/)#' => \Scern\Lira\Component\Front\InternalRedirect\InternalRedirect::class,
    '#^/json($|/)#' => \Scern\Lira\Component\Front\Json\Json::class,
    '#^/page/redirected/here($|/)#' => \Scern\Lira\Component\Front\TestRedirect\TestRedirect::class,
];