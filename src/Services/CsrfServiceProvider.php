<?php

declare(strict_types=1);

namespace App\Services;

use App\SuperGlobals\Session;
use function array_key_exists;

class CsrfServiceProvider
{
    private static string $key = 'csrf';

    public static function generate(string $key): string
    {
        $csrfKey = self::$key . '_' . $key;

        /** @var string[] $csrfList */
        $csrfList = Session::get(self::$key) ?? [];

        if (array_key_exists($csrfKey, $csrfList)) {
            unset($csrfList[$csrfKey]);
        }
        $csrf = bin2hex(random_bytes(32));
        $csrfList[$csrfKey] = $csrf;
        Session::put(self::$key, $csrfList);

        return $csrf;
    }

    public static function validate(string $key, string $csrf): bool
    {
        $csrfKey = self::$key . '_' . $key;

        /** @var string[] $csrfList */
        $csrfList = Session::get(self::$key) ?? [];

        if (! array_key_exists($csrfKey, $csrfList)) {
            return false;
        }

        return $csrf === $csrfList[$csrfKey];
    }
}
