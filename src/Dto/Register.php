<?php

declare(strict_types=1);

namespace App\Dto;

class Register
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
    ) {
    }
}
