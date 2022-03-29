<?php

declare(strict_types=1);

namespace App\Model;

class Article
{
    public ?int $id = null;

    public ?string $title = null;

    public ?string $excerpt = null;

    public ?string $content = null;

    public ?int $userId = null;

    public ?int $createdAt = null;

    public ?int $updatedAt = null;
}
