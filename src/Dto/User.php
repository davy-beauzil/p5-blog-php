<?php

declare(strict_types=1);

namespace App\Dto;

class User
{
    public int $id;

    public string $firstName;

    public string $lastName;

    public string $email;

    public bool $isValidated;

    public bool $isAdmin;

    public int $createdAt;

    public int $updatedAt;
}
