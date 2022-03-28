<?php

declare(strict_types=1);

namespace App\Dto\MyAccount;

class  UpdateMyAccountIdentity
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
    ) {
    }
}
