<?php

declare(strict_types=1);

namespace App\SuperGlobals;

class Env
{
    /**
     * Affect asked value to asked SuperGlobal $_ENV.
     */
    public static function put(string $key, mixed $value): void
    {
        $_ENV[$key] = $value;
    }

    /**
     * Return asked SuperGlobal $_ENV value.
     */
    public static function get(string $key): mixed
    {
        return $_ENV[$key] ?? null;
    }

    /**
     * Unset asked SuperGlobal $_ENV.
     */
    public static function forget(string $key): void
    {
        unset($_ENV[$key]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getGlobalSession(): array
    {
        return $_ENV;
    }
}
