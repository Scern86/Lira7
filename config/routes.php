<?php

return [
    '#^/(ru|en|gr|es|de)($|/)#'=>Scern\Lira\Component\Lang::class,
    '#^/admin($|/)#'=>\Scern\Lira\Component\Admin\Admin::class,
    '#^/api($|/)#'=>\Scern\Lira\Component\Api\Api::class,
    '#^(?!/admin|/api)($|/)#'=>\Scern\Lira\Component\Front\Front::class,
];