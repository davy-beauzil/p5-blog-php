<?php

declare(strict_types=1);

namespace App\Dto;

class MyAccountUpdate
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
    ) {
    }
}
