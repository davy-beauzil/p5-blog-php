<?php

declare(strict_types=1);

namespace App\ServiceProviders;

use App\Server\Session;

class AuthServiceProvider
{
    /**
     * @return array<string, mixed>|null
     */
    public static function getUser(): ?array
    {
        if (self::isAuthenticated()) {
            /** @var array<string, mixed> $user */
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
