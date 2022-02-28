<?php

declare(strict_types=1);

namespace App\Model;

class User
{
    public int $id;

    public string $first_name;

    public string $last_name;

    public string $email;

    public string $password;

    public bool $is_author;

    public bool $is_admin;

    public int $created_at;

    public int $updated_at;

    public function registerUser(string $first_name, string $last_name, string $email, string $password,): self
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;

        return $this;
    }
}
