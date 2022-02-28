<?php

declare(strict_types=1);

namespace App\Dto;

class Login
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
