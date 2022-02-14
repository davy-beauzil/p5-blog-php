<?php

declare(strict_types=1);

namespace App\Validator;

use const FILTER_VALIDATE_EMAIL;
use function mb_strlen;

class Validator
{
    public static function isEmail(string $email): bool
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public static function biggerThan(int $lenght, string $input): bool
    {
        if (mb_strlen($input) <= $lenght) {
            return false;
        }

        return true;
    }

    public static function lowerThan(int $lenght, string $input): bool
    {
        if (mb_strlen($input) >= $lenght) {
            return false;
        }

        return true;
    }

    public static function onlyAlphabet(string $input): bool
    {
        if (! ctype_alpha($input)) {
            return false;
        }

        return true;
    }

    public static function containsUppercase(string $input): bool
    {
        if (! preg_match('/[A-Z]/', $input)) {
            return false;
        }

        return true;
    }

    public static function containsLowercase(string $input): bool
    {
        if (! preg_match('/[a-z]/', $input)) {
            return false;
        }

        return true;
    }

    public static function containsNumber(string $input): bool
    {
        if (! preg_match('/\d/', $input)) {
            return false;
        }

        return true;
    }

    public static function containsSpecialCharacter(string $input): bool
    {
        if (! preg_match('/[^a-zA-Z\d]/', $input)) {
            return false;
        }

        return true;
    }
}
