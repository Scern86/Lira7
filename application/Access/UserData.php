<?php

namespace Scern\Lira\Application\Access;

readonly class UserData extends \Scern\Lira\Access\UserData
{
    public function __construct(
        public int $id=0,
        public string $login='guest',
        public string $name='Guest',
        public bool $is_active=false,
    )
    {
    }

    public function isLoggedIn(): bool
    {
        return $this->is_active;
    }
}