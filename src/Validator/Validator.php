<?php

declare(strict_types=1);

namespace App\Validator;

use const FILTER_VALIDATE_EMAIL;
use function mb_strlen;

class Validator
{
    public static function isEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) === false ? false : true;
    }

    public static function biggerThan(int $lenght, string $input): bool
    {
        return mb_strlen($input) > $lenght;
    }

    public static function lowerThan(int $lenght, string $input): bool
    {
        return mb_strlen($input) < $lenght;
    }

    public static function onlyAlphabet(string $input): bool
    {
        return ctype_alpha($input);
    }

    public static function containsUppercase(string $input): bool
    {
        return preg_match('/[A-Z]/', $input) === 1;
    }

    public static function containsLowercase(string $input): bool
    {
        return preg_match('/[a-z]/', $input) === 1;
    }

    public static function containsNumber(string $input): bool
    {
        return preg_match('/\d/', $input) === 1;
    }

    public static function containsSpecialCharacter(string $input): bool
    {
        return preg_match('/[^a-zA-Z\d]/', $input) === 1;
    }

    public static function validatePassword(string $password): bool
    {
        return preg_match('/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,}$/', $password) === 1;
    }
}
