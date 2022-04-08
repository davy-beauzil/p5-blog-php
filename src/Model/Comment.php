<?php

declare(strict_types=1);

namespace App\Model;

use App\Repository\UserRepository;

class Comment
{
    public ?int $id = null;

    public ?string $content = null;

    public ?string $isApprouved = null;

    public ?string $userId = null;

    public ?int $articleId = null;

    public ?int $createdAt = null;

    public ?int $updatedAt = null;

    public function getAuthor(): ?User
    {
        if ($this->userId !== null) {
            $userRepository = new UserRepository();

            return $userRepository->getUser('id', $this->userId);
        }

        return null;
    }
}
