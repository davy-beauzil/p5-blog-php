<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Router\Parameters;
use function is_string;
use PDOException;

class ArticleController extends AbstractController
{
    private ArticleRepository $repository;

    public function __construct()
    {
        $this->repository = new ArticleRepository();
    }

    /**
     * Affiche la page du compte courant.
     */
    public function article(Parameters $parameters): void
    {
        $id = $parameters->get['id'];
        if (! is_string($id)) {
            $this->redirectToRoute('homepage');
        } else {
            try {
                $article = $this->repository->getArticleWithAuthor($id);
                $this->render('article', [
                    'article' => $article,
                ]);
            } catch (PDOException) {
                $this->redirectToRoute('homepage');
            }
        }
    }
}
