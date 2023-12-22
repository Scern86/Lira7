<?php

namespace Scern\Lira;

use Scern\Lira\AccessControl\AccessManager;
use Scern\Lira\State\StateManager;

readonly class User
{
    public function __construct(protected AccessManager $accessManager,protected StateManager $stateManager,public bool $isGuest=true)
    {
    }

    public function isMethodAllowed(string $method): bool
    {
        return $this->accessManager->isAllowed($method);
    }
}