<?php

declare(strict_types=1);

namespace App\SuperGlobals;

use function array_key_exists;

class Post
{
    /**
     * Determine if all keys exist.
     */
    public static function has(string ...$keys): bool
    {
        foreach ($keys as $key) {
            if (! array_key_exists($key, self::getGlobalSession())) {
                return false;
            }
        }

        return true;
    }

    /**
     * Affect asked value to asked SuperGlobal $_POST.
     */
    public static function put(string $key, mixed $value): void
    {
        $_POST[$key] = $value;
    }

    /**
     * Return asked SuperGlobal $_POST value.
     */
    public static function get(string $key): mixed
    {
        return $_POST[$key] ?? null;
    }

    /**
     * Unset asked SuperGlobal $_POST.
     */
    public static function forget(string $key): void
    {
        unset($_POST[$key]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getGlobalSession(): array
    {
        return $_POST;
    }
}
