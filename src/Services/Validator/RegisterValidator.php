<?php

declare(strict_types=1);

namespace App\Services\Validator;

use App\Dto\Register;
use App\Services\Exception\RegisterException;

class RegisterValidator extends Validator
{
    public function validate(
        mixed $firstName,
        mixed $lastName,
        mixed $email,
        mixed $password,
        mixed $passwordConfirmation
    ): Register {
        if (! $this->biggerThan(2, $firstName) || ! $this->onlyAlphabet($firstName)) {
            throw new RegisterException('Le prénom doit faire au moins 3 caractères');
        }
        if (! $this->biggerThan(2, $lastName) || ! $this->onlyAlphabet($lastName)) {
            throw new RegisterException('Le nom doit faire au moins 3 caractères');
        }
        if (! $this->isEmail($email)) {
            throw new RegisterException('L’adresse mail est invalide');
        }
        if (! $this->validatePassword($password)) {
            throw new RegisterException(
                'Le mot de passe doit faire 8 caractères, et comporter une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.'
            );
        }
        if ($password !== $passwordConfirmation) {
            throw new RegisterException('Le mot de passe est différent.');
        }

        /** @var string $firstName */
        /** @var string $lastName */
        /** @var string $email */
        /** @var string $password */
        /** @var string $passwordConfirmation */
        return new Register($firstName, $lastName, $email, $password, $passwordConfirmation);
    }
}
