<?php

declare(strict_types=1);

namespace App\Services\Validator;

use App\Dto\Login;
use App\Services\Exception\LoginException;
use function is_string;

class LoginValidator extends Validator
{
    public function validate(mixed $email, mixed $password): Login
    {
        if (! self::isEmail($email)) {
            throw new LoginException('L’adresse mail est invalide');
        }
        if (! is_string($password)) {
            throw new LoginException('Le mot de passe doit être une chaine de caractères');
        }
        /** @var string $email */
        /** @var string $password */
        return new Login($email, $password);
    }
}
