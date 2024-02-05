<?php

namespace Scern\Lira\Access;

interface UserContract
{
    public function isLoggedIn(): bool;
    public function login(): bool;
    public function logout(): void;
    public function getUserData(): UserData;
    public function isMethodAllowed(string $method): bool;
}