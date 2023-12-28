<?php

namespace Scern\Lira;

use Scern\Lira\Access\AccessManager;
use Scern\Lira\Access\{Group,Role};
use Scern\Lira\State\StateStrategy;

class User
{
    protected array $groups;
    protected array $roles;
    public function __construct(protected AccessManager $accessManager, protected StateStrategy $stateManager, public readonly bool $isGuest=true)
    {
    }

    public function isMethodAllowed(string $method): bool
    {
        return $this->accessManager->isAllowed($method);
    }

    public function addGroup(Group $group): void
    {
        $this->groups[$group->name] = $group;
    }
    public function addRole(Role $role): void
    {
        $this->roles[$role->name] = $role;
    }

    public function login(string $login,string $password): bool
    {
        return false;
    }

    public function logout(): void
    {
    }
}