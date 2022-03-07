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
        try {
            $login = self::createLogin($parameters);
            $user = UserRepository::connectByEmail($login);
            Session::put('user', $user);

            return true;
        } catch (LoginException $e) {
            return [
                'type' => 'error',
                'text' => $e->getMessage(),
            ];
        }
    }

    private static function createLogin(Parameters $parameters): Login
    {
        if (is_string($parameters->post['email']) && is_string($parameters->post['password'])) {
            return new Login($parameters->post['email'], $parameters->post['password']);
        }
        throw new LoginException('Vos identifiants sont incorrects, veuillez réessayer.');
    }
}
