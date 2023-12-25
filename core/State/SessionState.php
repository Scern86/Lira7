<?php

namespace Scern\Lira\State;

use Scern\Lira\Traits\Getter;

class SessionState implements StateStrategy
{
    use Getter;
    protected array $values = [];

    public readonly string $stateId;

    public function init(): void
    {
        session_start();
        $this->values = $_SESSION;
        $this->stateId = session_id();
        session_write_close();
    }

    public function save(string $key,mixed $value): void
    {
        session_start();
        $_SESSION[$key] = $value;
        session_write_close();
    }

    public function clear(): void
    {
        session_start();
        session_unset();
        session_regenerate_id();
        session_destroy();
    }
}