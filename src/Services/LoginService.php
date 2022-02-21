<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\Login;
use App\Exception\LoginException;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Server\Session;
use function is_string;

class LoginService
{
    /**
     * @return true|array<string, string>
     */
    public static function login(Parameters $parameters): bool|array
    {
        if (! is_string($parameters->post['email']) ||
            ! is_string($parameters->post['password'])
        ) {
            return [
                'global' => 'Vos identifiants sont incorrects, veuillez réessayer.',
            ];
        }

        $login = new Login($parameters->post['email'], $parameters->post['password'],);

        try {
            $user = UserRepository::connectByEmail($login);
            Session::put('user', $user);
        } catch (LoginException $e) {
            return [
                'global' => $e->getMessage(),
            ];
        }

        return true;
    }
}
