<?php

namespace App\Model;

use App\Services\AuthServiceProvider;
use App\Services\Exception\ContactException;

class Contact
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $message;
    public int $userId;
    public int $createdAt;
    public int $updatedAt;

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
        if($user === null){
            throw new ContactException('Une erreur s’est produite lors du traitement de votre message');
        }
        $this->userId = $user->id;
        $this->message = $message;
        return $this;
    }
}