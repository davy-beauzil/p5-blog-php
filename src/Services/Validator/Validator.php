<?php

declare(strict_types=1);

namespace App\Services\Validator;

use const FILTER_VALIDATE_EMAIL;
use function is_string;
use function mb_strlen;

class Validator
{
    public function isEmail(mixed $email): bool
    {
        return is_string($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false ? false : true;
    }

    public function biggerThan(int $lenght, mixed $input): bool
    {
        return is_string($input) && mb_strlen($input) > $lenght;
    }

    public function lowerThan(int $lenght, mixed $input): bool
    {
        return is_string($input) && mb_strlen($input) < $lenght;
    }

    public function onlyAlphabet(mixed $input): bool
    {
        return is_string($input) && ctype_alpha($input);
    }

    public function containsUppercase(mixed $input): bool
    {
        return is_string($input) && preg_match('/[A-Z]/', $input) === 1;
    }

    public function containsLowercase(mixed $input): bool
    {
        return is_string($input) && preg_match('/[a-z]/', $input) === 1;
    }

    public function containsNumber(mixed $input): bool
    {
        return is_string($input) && preg_match('/\d/', $input) === 1;
    }

    public function containsSpecialCharacter(mixed $input): bool
    {
        return is_string($input) && preg_match('/[^a-zA-Z\d]/', $input) === 1;
    }

    public function validatePassword(mixed $password): bool
    {
        return is_string($password) && preg_match(
            '/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,}$/',
            $password
        ) === 1;
    }
}
