<?php

declare(strict_types=1);

namespace App\Dto\MyAccount;

class UpdatePassword
{
    public function __construct(
        public string $id,
        public string $currentPassword,
        public string $newPassword,
    ) {
    }
}
