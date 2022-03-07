<?php

declare(strict_types=1);

namespace App\ServiceProviders;

use App\Dto\User;
use App\Server\Session;

class AuthServiceProvider
{
    public static function getUser(): ?User
    {
        if (self::isAuthenticated()) {
            /** @var User $user */
            $user = Session::get('user');
            return $user;
        }

        return null;
    }

    public static function isAuthenticated(): bool
    {
        return Session::get('user') !== null;
    }

    public static function logout(): void
    {
        if (self::isAuthenticated()) {
            Session::forget('user');
        }
    }
}
