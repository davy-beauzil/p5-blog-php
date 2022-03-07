<?php

declare(strict_types=1);

namespace App\Voters;

use App\Dto\User;
use App\Exception\VoterException;
use App\ServiceProviders\AuthServiceProvider;
use function is_int;

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
        if (! is_int($subject)) {
            throw new VoterException(sprintf(
                'Le paramètre $subject n’est pas un integer. Voter : %s / Attribut : %s',
                self::class,
                self::IS_SAME
            ));
        }

        return $user instanceof User && $subject === $user->id;
    }
}
