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
    public const NBR_ARTICLES_PER_PAGE = 5;

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
                $this->render('articles/article', [
                    'article' => $article,
                    'comments' => $comments,
                ]);
            } catch (PDOException) {
                $this->render404('Une erreur s’est produite lors du chargement de la page.');
            }
        }
    }

    public function articles(Parameters $parameters): void
    {
        try {
            /** @var ?string $page */
            $page = $parameters->get['page'] ?? null;
            $page = ctype_digit($page) ? (int) $page : 1;
            $page = $page <= 0 ? 1 : $page;
            $nbrArticles = $this->articleRepository->countArticles();
            $pages = ceil($nbrArticles / self::NBR_ARTICLES_PER_PAGE);
            $page = $page > $pages ? 1 : $page;
            $firstArticle = ($page - 1) * self::NBR_ARTICLES_PER_PAGE;
            $articles = $this->articleRepository->getPaginatedArticles($firstArticle, self::NBR_ARTICLES_PER_PAGE);

            $this->render('articles/articles', [
                'articles' => $articles,
                'pages' => $pages,
                'currentPage' => $page,
            ]);
        } catch (PDOException) {
            $this->redirectToRoute('homepage', [
                'error' => 'Une erreur s’est produite lors de la récupération des articles',
            ]);
        }
    }
}
