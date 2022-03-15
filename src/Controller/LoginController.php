<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Login;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\LoginException;
use App\Services\Validator\LoginValidator;
use App\Services\Voters\IsLoggedInVoter;
use App\Services\Voters\Voters;
use App\SuperGlobals\Post;
use function is_string;

class LoginController extends AbstractController
{
    private UserRepository $repository;

    private LoginValidator $loginValidator;

    private Voters $voters;

    private Post $post;

    public function __construct()
    {
        $this->loginValidator = new LoginValidator();
        $this->repository = new UserRepository();
        $this->voters = new Voters();
        $this->post = new Post();
    }

    /*
     * GET /login
     */
    public function loginIndex(): void
    {
        if ($this->voters->vote(IsLoggedInVoter::IS_LOGGED_IN)) {
            $this->redirectToRoute('homepage');
        }

        $this->render('login/login', [
            'csrf' => CsrfServiceProvider::generate('login'),
        ]);
    }

    /*
     * POST /login
     */
    public function login(Parameters $parameters): void
    {
        if ($this->voters->vote(IsLoggedInVoter::IS_LOGGED_IN)) {
            $this->redirectToRoute('homepage');
        }
        $email = $this->post->get('email');
        $password = $this->post->get('password');
        $csrf = $this->post->get('_csrf');

        if ($email !== null && $password !== null && $csrf !== null) {
            try {
                $login = $this->checkLogin($email, $password, $csrf);
                $this->repository->connectByEmail($login);
                $this->redirectToRoute('homepage');
            } catch (LoginException $e) {
                $this->render('login/login', [
                    'messages' => [
                        [
                            'type' => 'error',
                            'text' => $e->getMessage(),
                        ],
                    ],
                ]);
            }
        }
    }

    private function checkLogin(mixed $email, mixed $password, mixed $csrf): Login
    {
        $login = $this->loginValidator->validate($email, $password);
        $checkCsrf = is_string($csrf) && $this->checkCSRF('login', $csrf);
        if (! $checkCsrf) {
            throw new LoginException('Une erreur est survenue lors de la connexion, veuillez réessayer.');
        }

        return $login;
    }
}
