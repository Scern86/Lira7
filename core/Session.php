<?php

namespace Scern\Lira;

readonly class Session
{
    public string $session_id;

    public function init(): void
    {
        session_start();
        $this->session_id = session_id();
        session_write_close();
    }

    public function destroy(): void
    {
        session_start();
        session_unset();
        session_regenerate_id();
        session_destroy();
    }
}