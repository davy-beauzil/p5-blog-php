<?php

declare(strict_types=1);

namespace App\Voters;

use App\Server\Session;
use function in_array;

class LoginOrRegisterVoter implements VoterInterface
{
    public const REGISTER = 'register';

    public const LOGIN = 'login';

    public function canVote(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::REGISTER, self::LOGIN], true);
    }

    public function vote(string $attribute, mixed $subject): bool
    {
        return Session::get('user') === null;
    }
}
