<?php

declare(strict_types=1);

namespace App\Model;

use DateTimeImmutable;

class User
{
    public int $id;

    public string $firstname;

    public string $lastname;

    public string $email;

    public string $password;

    public bool $isAuthor;

    public bool $isAdmin;

    public DateTimeImmutable $created_at;

    public DateTimeImmutable $updated_at;
}
