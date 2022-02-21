<?php

declare(strict_types=1);

namespace App\Validator;

use App\Dto\Register;

class RegisterValidator extends Validator
{
    /**
     * @return true|array<string, string>
     */
    public static function validate(Register $register): bool|array
    {
        $errors = [];
        if (! self::biggerThan(3, $register->first_name) || ! self::onlyAlphabet($register->first_name)) {
            $errors['first_name'] = 'Le prénom doit faire au moins 3 caractères';
        }

        if (! self::biggerThan(3, $register->last_name) || ! self::onlyAlphabet($register->last_name)) {
            $errors['last_name'] = 'Le nom doit faire au moins 3 caractères';
        }
        if (! self::isEmail($register->email)) {
            $errors['email'] = 'L’adresse mail est invalide';
        }
        if (
            ! self::biggerThan(8, $register->password) ||
            ! self::containsUppercase($register->password) ||
            ! self::containsLowercase($register->password) ||
            ! self::containsNumber($register->password) ||
            ! self::containsSpecialCharacter($register->password)
        ) {
            $errors['password'] = 'Le mot de passe doit faire 8 caractères, et comporter une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.';
        } else {
            if ($register->password !== $register->password_confirmation) {
                $errors['password_confirmation'] = 'Le mot de passe est différent.';
            }
        }

        return empty($errors) ? true : $errors;
    }
}
