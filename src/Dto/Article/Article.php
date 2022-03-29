<?php

declare(strict_types=1);

namespace App\Dto\Article;

class Article
{
    public function __construct(
        public string $title,
        public string $excerpt,
        public string $content,
        public int $userId,
    ) {
    }
}
