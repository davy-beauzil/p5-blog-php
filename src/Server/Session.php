<?php

declare(strict_types=1);

namespace App\Server;

class Session
{
    /**
     * Affect asked value to asked SuperGlobal $_SESSION.
     */
    public static function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Return asked SuperGlobal $_SESSION value.
     */
    public static function get(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Unset asked SuperGlobal $_SESSION.
     */
    public static function forget(string $key): void
    {
        unset($_SESSION[$key]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getGlobalSession(): array
    {
        return $_SESSION;
    }
}
