<?php

declare(strict_types=1);

namespace App\Services;

use App\Model\User;
use App\SuperGlobals\Session;

class AuthServiceProvider
{
    public static function getUser(): ?User
    {
        if (self::isAuthenticated()) {
            return Session::get('user') instanceof User ? Session::get('user') : null;
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
