<?php

declare(strict_types=1);

namespace App\Voters;

use App\Dto\User;
use App\Server\Session;

class IsLoggedInVoter implements VoterInterface
{
    public const IS_LOGGED_IN = 'isLoggedIn';

    public function canVote(string $attribute, mixed $subject): bool
    {
        return $attribute === self::IS_LOGGED_IN;
    }

    public function vote(string $attribute, mixed $subject): bool
    {
        $user = Session::get('user');

        return $user instanceof User;
    }
}
