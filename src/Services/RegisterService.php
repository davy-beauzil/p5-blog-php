<?php

declare(strict_types=1);

namespace App\Services;

use App\Exception\RegisterException;
use App\Model\User;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Validator\RegisterValidator;
use function is_string;
use const PASSWORD_DEFAULT;

class RegisterService
{
    /**
     * @return true|array<string, string>
     */
    public static function register(Parameters $parameters): bool|array
    {
        if (! is_string($parameters->post['first_name']) ||
            ! is_string($parameters->post['last_name']) ||
            ! is_string($parameters->post['email']) ||
            ! is_string($parameters->post['password'])
        ) {
            return [
                'global' => 'Une erreur s’est produite lors de la création de votre compte. Veuillez réessayer ultérieurement.',
            ];
        }

        $user = new User();
        $register = $user->registerUser(
            $parameters->post['first_name'],
            $parameters->post['last_name'],
            $parameters->post['email'],
            $parameters->post['password']
        );

        $isValid = RegisterValidator::validate($register);

        if ($isValid === true) {
            $register->password = password_hash($register->password, PASSWORD_DEFAULT);
            try {
                UserRepository::create($register);
            } catch (RegisterException $e) {
                return [
                    'global' => $e->getMessage(),
                ];
            }

            return true;
        }

        return $isValid;
    }
}
