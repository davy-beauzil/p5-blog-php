<?php

declare(strict_types=1);

namespace App\Dto;

class UpdateUser
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $isValidated,
    ) {
    }
}
