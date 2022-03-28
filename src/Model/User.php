<?php

declare(strict_types=1);

namespace App\Model;

class User
{
    public ?int $id = null;

    public ?string $firstName = null;

    public ?string $lastName = null;

    public ?string $email = null;

    public ?string $password = null;

    public ?bool $isValidated = null;

    public ?bool $isAdmin = null;

    public ?int $createdAt = null;

    public ?int $updatedAt = null;
}
