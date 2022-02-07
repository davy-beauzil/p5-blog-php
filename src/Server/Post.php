<?php

declare(strict_types=1);

namespace App\Server;

class Post
{
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
