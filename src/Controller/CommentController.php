<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Router\Parameters;
use App\Services\AuthServiceProvider;
use App\Services\Exception\CommentException;
use App\Services\Voters\IsAdminVoter;
use App\Services\Voters\IsCurrentUserVoter;
use App\Services\Voters\Voters;
use function is_string;
use function mb_strlen;
use PDOException;

class CommentController extends AbstractController
{
    public const NBR_USERS_PER_PAGE = 10;

    private CommentRepository $commentRepository;

    private Voters $voters;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
        $this->voters = new Voters();
    }

    public function manager(Parameters $parameters): void
    {
        if (! $this->voters->vote(IsAdminVoter::IS_ADMIN)) {
            $this->redirectToRoute('homepage');
        }

        try {
            /** @var ?string $page */
            $page = $parameters->get['page'] ?? null;
            $page = ctype_digit($page) ? (int) $page : 1;
            $page = $page <= 0 ? 1 : $page;
            $nbrComments = $this->commentRepository->countComments();
            $pages = ceil($nbrComments / self::NBR_USERS_PER_PAGE);
            $page = $page > $pages ? 1 : $page;
            $firstComment = ($page - 1) * self::NBR_USERS_PER_PAGE;
            $comments = $this->commentRepository->getPaginatedComments($firstComment, self::NBR_USERS_PER_PAGE);

            $this->render('dashboard/comments/manager', [
                'comments' => $comments,
                'pages' => $pages,
                'currentPage' => $page,
            ]);
        } catch (PDOException) {
            $this->redirectToRoute('homepage', [
                'error' => 'Une erreur s’est produite lors de la récupération des commentaires',
            ]);
        }
    }

    public function add(Parameters $parameters): void
    {
        $comment = $parameters->post['comment'];
        $articleId = $parameters->get['article_id'];
        try {
            if (! is_string($comment) || mb_strlen($comment) === 0 || $articleId === null || ! is_string($articleId)) {
                throw new CommentException('Une erreur s’est produite lors de l’enregistrement du commentaire');
            }
            $user = AuthServiceProvider::getUser();
            if ($user === null) {
                throw new CommentException('Une erreur s’est produite lors de l’enregistrement du commentaire');
            }
            $this->commentRepository->add($comment, $user, $articleId);
            $this->redirectToRoute('article', [
                'id' => $articleId,
            ]);
        } catch (CommentException $e) {
            $this->redirectToRoute('article', [
                'id' => $articleId,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function valid(Parameters $parameters): void
    {
        $commentId = $parameters->get['comment_id'];
        try {
            if ($commentId === null) {
                throw new CommentException('Une erreur s’est produite lors de la validation du commentaire');
            }
            $this->commentRepository->valid($commentId);
            $this->redirectToRoute('comments_manager', [
                'success' => 'Le commentaire a bien été validé.',
            ]);
        } catch (CommentException $e) {
            $this->redirectToRoute('comments_manager', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function invalid(Parameters $parameters): void
    {
        $commentId = $parameters->get['comment_id'];
        try {
            if ($commentId === null) {
                throw new CommentException('Une erreur s’est produite lors de l’invalidation du commentaire');
            }
            $this->commentRepository->invalid($commentId);
            $this->redirectToRoute('comments_manager', [
                'success' => 'Le commentaire a bien été invalidé.',
            ]);
        } catch (CommentException $e) {
            $this->redirectToRoute('comments_manager', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function update(Parameters $parameters): void
    {
        $userId = $parameters->put['user_id'];
        if (! $this->voters->vote(IsCurrentUserVoter::IS_SAME, $userId)) {
            $this->redirectToRoute('homepage');
        }
        $commentId = $parameters->get['comment_id'];
        $comment = $parameters->put['comment'];
        try {
            if (! is_string($comment) || mb_strlen($comment) === 0) {
                throw new CommentException('Une erreur s’est produite lors de la modification du commentaire');
            }
            $this->commentRepository->update($commentId, $comment);
            $this->redirectToLastPage([
                'success' => 'Votre commentaire a bien été modifié.',
            ]);
        } catch (CommentException $e) {
            $this->redirectToLastPage([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function delete(Parameters $parameters): void
    {
        $commentId = $parameters->get['comment_id'];
        try {
            $comment = $this->commentRepository->get($commentId);
            if (! $this->voters->vote(IsCurrentUserVoter::IS_SAME, $comment->userId)) {
                $this->redirectToRoute('homepage');
            }
            $this->commentRepository->delete($comment->id);
            $this->redirectToLastPage([
                'success' => 'Votre commentaire a bien été supprimé.',
            ]);
        } catch (CommentException $e) {
            $this->redirectToLastPage([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
