<?php

declare(strict_types=1);

namespace App\Services\Voters;

use App\Model\User;
use App\Services\AuthServiceProvider;
use function is_string;

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
        $subject = is_string($subject) && ctype_digit($subject) ? (int) $subject : $subject;

        return $user instanceof User && $subject === $user->id;
    }
}
