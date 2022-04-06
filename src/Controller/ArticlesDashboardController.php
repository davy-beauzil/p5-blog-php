<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Article\Article;
use App\Model\Article as ArticleModel;
use App\Repository\ArticleRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\CreateArticleException;
use App\Services\Exception\UpdateArticleException;
use App\Services\Validator\CreateArticleValidator;
use App\Services\Validator\UpdateArticleValidator;
use App\Services\Voters\IsAdminVoter;
use App\Services\Voters\Voters;
use function is_string;
use PDOException;

class ArticlesDashboardController extends AbstractController
{
    public const NBR_USERS_PER_PAGE = 10;

    private Voters $voters;

    private ArticleRepository $repository;

    private CreateArticleValidator $createArticleValidator;

    private UpdateArticleValidator $updateArticleValidator;

    public function __construct()
    {
        $this->voters = new Voters();
        $this->repository = new ArticleRepository();
        $this->createArticleValidator = new createArticleValidator();
        $this->updateArticleValidator = new UpdateArticleValidator();
    }

    public function index(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        try {
            /** @var ?string $page */
            $page = $parameters->get['page'] ?? null;
            $page = ctype_digit($page) ? (int) $page : 1;
            $page = $page <= 0 ? 1 : $page;
            $nbrArticles = $this->repository->countArticles();
            $pages = ceil($nbrArticles / self::NBR_USERS_PER_PAGE);
            $page = $page > $pages ? 1 : $page;
            $firstArticle = ($page - 1) * self::NBR_USERS_PER_PAGE;
            $articles = $this->repository->getPaginatedArticles($firstArticle, self::NBR_USERS_PER_PAGE);

            $this->render('dashboard/articles/manager', [
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

    public function createIndex(): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        $this->render('dashboard/articles/create', [
            'csrf' => CsrfServiceProvider::generate('create-article'),
        ]);
    }

    public function create(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        try {
            $createArticle = $this->checkCreate($parameters);
            $this->repository->create($createArticle);
            $this->redirectToRoute('adminArticles', [
                'success' => 'Votre article a bien été créé.',
            ]);
        } catch (CreateArticleException $e) {
            $this->redirectToRoute('createArticle', [
                'error' => $e->getMessage(),
            ]);
        }

        $this->render('dashboard/articles/create');
    }

    public function delete(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        $id = $parameters->get['id'];
        if (! is_string($id)) {
            $this->redirectToRoute('homepage', [
                'error' => 'Une erreur est survenue lors de la suppression de l’article',
            ]);
        } else {
            try {
                $this->repository->delete($id);
                $this->redirectToRoute('adminArticles', [
                    'success' => 'L’article a bien été supprimé',
                ]);
            } catch (CreateArticleException $e) {
                $this->redirectToRoute('adminArticles', [
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    public function updateIndex(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }
        $id = $parameters->get['id'];
        if (! is_string($id)) {
            $this->redirectToRoute('adminArticles', [
                'error' => 'Impossible de retrouver l’article en question',
            ]);
        } else {
            try {
                $article = $this->repository->getArticle($id);
                $this->render('dashboard/articles/create', [
                    'article' => $article,
                    'csrf' => CsrfServiceProvider::generate('update-article'),
                ]);
            } catch (PDOException) {
                $this->redirectToRoute('adminArticles', [
                    'error' => 'Impossible de retrouver l’article en question',
                ]);
            }
        }
    }

    public function update(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('adminArticles');
        }
        $id = $parameters->get['id'];
        if ($id === null) {
            $this->redirectToRoute('adminArticles', [
                'error' => 'Impossible de retrouver l’article en question',
            ]);
        }
        try {
            $article = $this->checkUpdate($parameters);
            $this->repository->update($article);
            $this->redirectToRoute('adminArticles', [
                'success' => 'L’article a bien été modifié',
            ]);
        } catch (UpdateArticleException $e) {
            $this->redirectToRoute('adminArticles', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function checkCreate(Parameters $parameters): Article
    {
        if (! $parameters->has(Parameters::POST, 'title', 'excerpt', 'content', '_csrf')) {
            throw new CreateArticleException('Un des champs requis pour la création d’un article est manquant');
        }
        if (! is_string($parameters->post['_csrf'])) {
            throw new CreateArticleException('Une erreur s’est produite lors de la création de l’article');
        }
        $updateUser = $this->createArticleValidator->validate(
            $parameters->post['title'],
            $parameters->post['excerpt'],
            $parameters->post['content'],
        );
        $checkCsrf = CsrfServiceProvider::validate('create-article', $parameters->post['_csrf']);
        if ($checkCsrf === false) {
            throw new CreateArticleException('Le CSRF n’est pas valide');
        }

        return $updateUser;
    }

    private function checkUpdate(Parameters $parameters): ArticleModel
    {
        if (! $parameters->has(Parameters::PUT, 'title', 'content', 'excerpt', '_csrf')) {
            throw new UpdateArticleException('Un des champs est manquant pour modifier l’article');
        }
        if (! is_string($parameters->put['_csrf'])) {
            throw new UpdateArticleException('Le formulaire est invalide.');
        }
        $updateArticle = $this->updateArticleValidator->validate($parameters);
        $checkCsrf = CsrfServiceProvider::validate('update-article', $parameters->put['_csrf']);
        if ($checkCsrf === false) {
            throw new UpdateArticleException('Le CSRF n’est pas valide');
        }

        return $updateArticle;
    }
}
