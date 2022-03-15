<?php

declare(strict_types=1);

namespace App\Services\Voters;

class Voters
{
    /**
     * @var VoterInterface[]
     */
    private array $voters = [];

    public function vote(string $attribute, mixed $subject = null): bool
    {
        $this->addVoters();

        foreach ($this->voters as $voter) {
            if ($voter->canVote($attribute, $subject)) {
                if ($voter->vote($attribute, $subject)) {
                    return true;
                }
            }
        }

        return false;
    }

    private function addVoters(): void
    {
        $this->voters[] = new IsLoggedInVoter();
        $this->voters[] = new IsCurrentUserVoter();
    }
}
