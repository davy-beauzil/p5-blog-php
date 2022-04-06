<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Login;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Services\AuthServiceProvider;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\CommentException;
use App\Services\Exception\LoginException;
use App\Services\Validator\LoginValidator;
use App\Services\Voters\IsLoggedInVoter;
use App\Services\Voters\Voters;
use App\SuperGlobals\Post;
use function is_string;

class CommentController extends AbstractController
{
    private CommentRepository $commentRepository;

    public function __construct()
    {
        $this->commentRepository = new CommentRepository();
    }

    public function add(Parameters $parameters): void
    {
        $comment = $parameters->post['comment'];
        $articleId = $parameters->get['article_id'];
        if(!is_string($comment) || strlen($comment) === 0 || $articleId === null){
            dd($comment);
        }
        try{
            $this->commentRepository->add($comment, AuthServiceProvider::getUser(), $articleId);
            $this->redirectToRoute('article', ['id' => $articleId]);
        }catch(CommentException $e){
            $this->redirectToRoute('article', ['id' => $articleId, 'error' => $e->getMessage()]);
        }
    }
}
