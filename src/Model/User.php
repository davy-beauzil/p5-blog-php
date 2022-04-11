<?php

declare(strict_types=1);

namespace App\Model;

class User
{
    public int $id;

    public string $firstName;

    public string $lastName;

    public string $email;

    public ?string $password;

    public bool $isValidated;

    public bool $isAdmin;

    public int $createdAt;

    public int $updatedAt;
}
