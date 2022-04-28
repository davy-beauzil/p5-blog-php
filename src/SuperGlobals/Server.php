<?php

declare(strict_types=1);

namespace App\SuperGlobals;

class Server
{
    /**
     * Affect asked value to asked SuperGlobal $_SERVER.
     */
    public static function put(string $key, mixed $value): void
    {
        $_SERVER[$key] = $value;
    }

    /**
     * Return asked SuperGlobal $_SERVER value.
     */
    public static function get(string $key): mixed
    {
        if(key_exists($key, $_SERVER) ){
            if (is_string($_SERVER[$key])) {
                return htmlspecialchars($_SERVER[$key]);
            }
            return $_SERVER[$key];
        }
        return null;
    }

    /**
     * Unset asked SuperGlobal $_SERVER.
     */
    public static function forget(string $key): void
    {
        unset($_SERVER[$key]);
    }

    /**
     * @return array<string, mixed>
     */
    public static function getGlobalSession(): array
    {
        return $_SERVER;
    }
}
