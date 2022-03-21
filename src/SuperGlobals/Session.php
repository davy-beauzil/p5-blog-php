<?php

declare(strict_types=1);

namespace App\SuperGlobals;

use const PHP_SESSION_NONE;

class Session
{
    /**
     * Affect asked value to asked SuperGlobal $_SESSION.
     */
    public static function put(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Return asked SuperGlobal $_SESSION value.
     */
    public static function get(string $key): mixed
    {
        self::start();

        return $_SESSION[$key] ?? null;
    }

    /**
     * Unset asked SuperGlobal $_SESSION.
     */
    public static function forget(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getGlobalSession(): array
    {
        self::start();

        return $_SESSION;
    }

    private static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
