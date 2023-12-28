<?php

namespace Scern\Lira\Component\Front;

use Scern\Lira\Access\AccessManager;
use Scern\Lira\State\StateStrategy;

class User extends \Scern\Lira\User
{
    public function __construct(AccessManager $accessManager, StateStrategy $stateManager)
    {
        $stateManager->init();
        $isGuest = !isset($stateManager->isLoggedIn);
        parent::__construct($accessManager,$stateManager,$isGuest);
    }

    public function login(string $login, string $password): bool
    {
        if ($login == 'test' && $password == '1234') {
            $this->stateManager->save('isLoggedIn',true);
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        $this->stateManager->clear();
    }
}