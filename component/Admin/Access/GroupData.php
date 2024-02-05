<?php

namespace Scern\Lira\Component\Admin\Access;

use Scern\Lira\Access\Permissions;

class GroupData implements Permissions
{
    public function __construct(
        public int $id = 0,
        public string $name = 'Guests',
        protected array $actions = [],
    )
    {
    }

    public function isMethodAllowed(string $method): bool
    {
        return $this->actions[$method] ?? false;
    }
}