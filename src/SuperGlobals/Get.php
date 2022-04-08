<?php

declare(strict_types=1);

namespace App\SuperGlobals;

use function is_string;

class Get
{
    /**
     * Affect asked value to asked SuperGlobal $_GET.
     */
    public static function put(string $key, mixed $value): void
    {
        $_GET[$key] = $value;
    }

    /**
     * Return asked SuperGlobal $_GET value.
     */
    public static function get(string $key): mixed
    {
        if (is_string($_GET[$key])) {
            return htmlspecialchars($_GET[$key]);
        }

        return $_GET[$key];
    }

    /**
     * Unset asked SuperGlobal $_GET.
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
        return array_map('htmlspecialchars', $_GET);
    }
}
