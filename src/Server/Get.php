<?php

namespace App\Server;

class Get
{
    /**
     * Affect asked value to asked SuperGlobal $_GET
     */
    public static function put(string $key, mixed $value): void
    {
        $_GET[$key] = $value;
    }

    /**
     * Return asked SuperGlobal $_GET value
     */
    public static function get(string $key): mixed
    {
        return ($_GET[$key] ?? null);
    }

    /**
     * Unset asked SuperGlobal $_GET
     */
    public static function forget(string $key): void
    {
        unset($_GET[$key]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getGlobalSession(): array
    {
        return $_GET;
    }
}