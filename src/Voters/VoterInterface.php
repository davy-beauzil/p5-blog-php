<?php

declare(strict_types=1);

namespace App\Voters;

interface VoterInterface
{
    public function canVote(string $attribute, mixed $subject): bool;

    public function vote(string $attribute, mixed $subject): bool;
}
