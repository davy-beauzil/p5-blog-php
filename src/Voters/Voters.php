<?php

declare(strict_types=1);

namespace App\Voters;

class Voters
{
    /**
     * @var VoterInterface[]
     */
    private static array $voters = [];

    public static function vote(string $attribute, mixed $subject = null): bool
    {
        self::addVoters();

        foreach (self::$voters as $voter) {
            if ($voter->canVote($attribute, $subject)) {
                if ($voter->vote($attribute, $subject)) {
                    return true;
                }
            }
        }

        return false;
    }

    private static function addVoters(): void
    {
        self::$voters[] = new IsLoggedInVoter();
        self::$voters[] = new IsCurrentUserVoter();
    }
}
