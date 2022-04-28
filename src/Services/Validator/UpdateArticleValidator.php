<?php

declare(strict_types=1);

namespace App\Services\Validator;

use App\Model\Article;
use App\Router\Parameters;
use App\Services\Exception\UpdateArticleException;
use function is_string;

class UpdateArticleValidator extends Validator
{
    public function validate(Parameters $parameters): Article
    {
        if ($parameters->put['id'] === null ||
            $parameters->put['title'] === null ||
            $parameters->put['content'] === null ||
            $parameters->put['author'] === null ||
            $parameters->put['excerpt'] === null
        ) {
            throw new UpdateArticleException('Un des champs pour la modification d’un utilisateur est manquant');
        }

        if (! $this->biggerThan(0, $parameters->put['title']) ||
            ! $this->lowerThan(256, $parameters->put['title']) ||
            ! is_string($parameters->put['title'])) {
            throw new UpdateArticleException('Le titre est obligatoire et peut faire jusqu’à 255 caractères.');
        }

        if (! $this->biggerThan(0, $parameters->put['excerpt']) ||
            ! $this->lowerThan(256, $parameters->put['excerpt']) ||
            ! is_string($parameters->put['excerpt'])
        ) {
            throw new UpdateArticleException('Le chapô est obligatoire et peut faire jusqu’à 255 caractères.');
        }

        if (! $this->biggerThan(0, $parameters->put['content']) ||
            ! is_string($parameters->put['content'])
        ) {
            throw new UpdateArticleException('Le contenu est obligatoire.');
        }

        /** @var array<string, string> $put */
        $put = $parameters->put;
        $article = new Article();
        $article->id = (int) $put['id'];
        $article->title = $put['title'];
        $article->excerpt = $put['excerpt'];
        $article->content = $put['content'];
        $article->userId = (int) $put['author'];

        return $article;
    }
}
