<?php

namespace Scern\Lira\Access;

readonly class User implements UserContract
{
    protected readonly UserData $userData;
    public function isLoggedIn(): bool
    {
        return $this->userData->isLoggedIn();
    }
    public function login(): bool
    {
        return false;
    }

    public function getUserData(): UserData
    {
        return $this->userData;
    }

    public function logout(): void
    {
    }
}