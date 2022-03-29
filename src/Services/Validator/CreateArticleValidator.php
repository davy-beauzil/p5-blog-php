<?php

declare(strict_types=1);

namespace App\Services\Validator;

use App\Dto\Article\Article;
use App\Services\AuthServiceProvider;
use App\Services\Exception\CreateArticleException;
use function is_string;

class CreateArticleValidator extends Validator
{
    public function validate(mixed $title, mixed $excerpt, mixed $content,): Article {
        if (! $this->biggerThan(0, $title) || ! is_string($title)) {
            throw new CreateArticleException('Le titre ne doit pas être vide.');
        }
        if (! $this->biggerThan(0, $excerpt) || ! $this->lowerThan(254, $excerpt) || ! is_string($excerpt)) {
            throw new CreateArticleException('Le chapô est obligatoire et peut faire jusqu’a 255 caractères.');
        }
        if (! $this->biggerThan(0, $content) || ! is_string($content)) {
            throw new CreateArticleException('Le contenu ne doit pas être vide.');
        }
        $user = AuthServiceProvider::getUser();
        if ($user === null || $user->id === null) {
            throw new CreateArticleException('Une erreur est survenue pendant la validation des données.');
        }

        /** @var string $title */
        /** @var string $excerpt */
        /** @var string $content */
        return new Article($title, $excerpt, $content, $user->id);
    }
}
