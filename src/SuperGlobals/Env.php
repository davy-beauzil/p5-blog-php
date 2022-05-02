<?php

declare(strict_types=1);

namespace App\SuperGlobals;

use function array_key_exists;
use function is_string;

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
        if (array_key_exists($key, $_ENV)) {
            if (is_string($_ENV[$key])) {
                return htmlspecialchars($_ENV[$key]);
            }

            return $_ENV[$key];
        }

        return null;
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
