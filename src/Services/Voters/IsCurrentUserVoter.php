<?php

declare(strict_types=1);

namespace App\Services\Voters;

use App\Model\User;
use App\Services\AuthServiceProvider;

class IsCurrentUserVoter implements VoterInterface
{
    public const IS_SAME = 'checkIfItsCurrentUser';

    public function canVote(string $attribute, mixed $subject): bool
    {
        return $attribute === self::IS_SAME;
    }

    public function vote(string $attribute, mixed $subject): bool
    {
        $user = AuthServiceProvider::getUser();

        return $user instanceof User && $subject === $user->id;
    }
}
