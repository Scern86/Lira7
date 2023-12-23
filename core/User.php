<?php

namespace Scern\Lira;

use Scern\Lira\Access\AccessManager;
use Scern\Lira\State\StateStrategy;

readonly class User
{
    public function __construct(protected AccessManager $accessManager, protected StateStrategy $stateManager, public bool $isGuest=true)
    {
    }

    public function isMethodAllowed(string $method): bool
    {
        return $this->accessManager->isAllowed($method);
    }
}