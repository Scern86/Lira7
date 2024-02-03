<?php

namespace Scern\Lira\Application\Access;

readonly class LoginData
{
    public function __construct(
        public int $id=0,
        public string $created = '1970-01-01',
        public string $ssid='',
        public string $ip_address='',
        public int $id_user=0,
        public bool $is_active=false,
        public string $component='',
    )
    {
    }
}