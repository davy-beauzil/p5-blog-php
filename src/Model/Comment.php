<?php

declare(strict_types=1);

namespace App\Model;

use App\Repository\UserRepository;

class Comment
{
    public int $id;

    public string $content;

    public string $isApprouved;

    public string $userId;

    public int $articleId;

    public int $createdAt;

    public int $updatedAt;

    public function getAuthor(): ?User
    {
        $userRepository = new UserRepository();

        return $userRepository->getUser('id', $this->userId);
    }
}
