<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use App\Router\Parameters;
use function is_string;
use PDOException;

class ArticleController extends AbstractController
{
    private ArticleRepository $articleRepository;

    private CommentRepository $commentRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->commentRepository = new CommentRepository();
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
                $article = $this->articleRepository->getArticleWithAuthor($id);
                $comments = $this->commentRepository->getForArticle($id);
                $this->render('article', [
                    'article' => $article,
                    'comments' => $comments,
                ]);
            } catch (PDOException) {
                $this->redirectToRoute('homepage');
            }
        }
    }
}
