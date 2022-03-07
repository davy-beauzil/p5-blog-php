<?php

declare(strict_types=1);

namespace App\Model;

class User
{
    public int $id;

    public string $firstName;

    public string $lastName;

    public string $email;

    public string $password;

    public bool $isAuthor;

    public bool $isAdmin;

    public int $createdAt;

    public int $updatedAt;

    public function registerUser(string $firstName, string $lastName, string $email, string $password,): self
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;

        return $this;
    }
}
