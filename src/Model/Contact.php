<?php

declare(strict_types=1);

namespace App\Model;

use App\Repository\UserRepository;
use App\Services\AuthServiceProvider;
use App\Services\Exception\ContactException;

class Contact
{
    public int $id;

    public ?string $firstName;

    public ?string $lastName;

    public ?string $email;

    public string $message;

    public ?int $userId;

    public int $createdAt;

    public int $updatedAt;

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function createForLogoutUser(string $firstName, string $lastName, string $email, string $message): self
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->message = $message;

        return $this;
    }

    public function createForLoggedInUser(string $message): self
    {
        $user = AuthServiceProvider::getUser();
        if ($user === null) {
            throw new ContactException('Une erreur s’est produite lors du traitement de votre message');
        }
        $this->userId = $user->id;
        $this->message = $message;

        return $this;
    }

    public function getAuthor(): ?User
    {
        if ($this->userId !== null) {
            return $this->userRepository->getUser('id', (string) $this->userId);
        }

        return null;
    }
}
