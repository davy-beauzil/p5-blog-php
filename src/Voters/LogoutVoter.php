<?php

declare(strict_types=1);

namespace App\Voters;

use App\Server\Session;
use function array_key_exists;
use function is_array;

class LogoutVoter implements VoterInterface
{
    public const LOGOUT = 'logout';

    public function canVote(string $attribute, mixed $subject): bool
    {
        return $attribute === self::LOGOUT;
    }

    public function vote(string $attribute, mixed $subject): bool
    {
        $user = Session::get('user');

        return $user !== null && is_array($user) && array_key_exists('id', $user);
    }
}
