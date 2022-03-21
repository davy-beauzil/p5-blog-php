<?php

declare(strict_types=1);

namespace App\Services\Voters;

use App\Model\User;
use App\SuperGlobals\Session;

class IsAdminVoter implements VoterInterface
{
    public const IS_ADMIN = 'isAdmin';

    public function canVote(string $attribute, mixed $subject): bool
    {
        return $attribute === self::IS_ADMIN;
    }

    public function vote(string $attribute, mixed $subject): bool
    {
        $user = Session::get('user');

        return $user instanceof User && $user->isAdmin === true;
    }
}
