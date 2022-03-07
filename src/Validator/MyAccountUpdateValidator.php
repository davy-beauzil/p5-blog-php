<?php

declare(strict_types=1);

namespace App\Validator;

use App\Dto\MyAccountUpdate;

class MyAccountUpdateValidator extends Validator
{
    /**
     * @return true|array<string, string>
     */
    public static function validate(MyAccountUpdate $myAccount): bool|array
    {
        $errors = [];
        if (! self::biggerThan(2, $myAccount->firstName) || ! self::onlyAlphabet($myAccount->firstName)) {
            $errors['firstName'] = 'Le prénom doit faire au moins 3 caractères';
        }

        if (! self::biggerThan(2, $myAccount->lastName) || ! self::onlyAlphabet($myAccount->lastName)) {
            $errors['lastName'] = 'Le nom doit faire au moins 3 caractères';
        }

        return empty($errors) ? true : $errors;
    }
}
