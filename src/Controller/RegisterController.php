<?php

declare(strict_types=1);

namespace App\Controller;

use App\Dto\Register;
use App\Repository\UserRepository;
use App\Router\Parameters;
use App\Services\CsrfServiceProvider;
use App\Services\Exception\RegisterException;
use App\Services\Validator\RegisterValidator;
use App\Services\Voters\IsLoggedInVoter;
use App\Services\Voters\Voters;
use App\SuperGlobals\Post;
use function is_string;

class RegisterController extends AbstractController
{
    private UserRepository $repository;

    private RegisterValidator $registerValidator;

    private Voters $voters;

    public function __construct()
    {
        $this->registerValidator = new RegisterValidator();
        $this->repository = new UserRepository();
        $this->voters = new Voters();
    }

    /*
     * GET /register
     */
    public function registerIndex(): void
    {
        if ($this->voters->vote(IsLoggedInVoter::IS_LOGGED_IN)) {
            $this->redirectToRoute('homepage');
        }

        $this->render('login/register', [
            'csrf' => CsrfServiceProvider::generate('register'),
        ]);
    }

    /*
     * POST /register
     */
    public function register(Parameters $parameters): void
    {
        if ($this->voters->vote(IsLoggedInVoter::IS_LOGGED_IN)) {
            $this->redirectToRoute('homepage');
        }

        try {
            $register = $this->checkRegister();
            $this->repository->create($register);
            $this->redirectToRoute('login');
        } catch (RegisterException $e) {
            $this->render('login/register', [
                'messages' => [[
                    'type' => 'danger',
                    'text' => $e->getMessage(),
                ]],
                'csrf' => CsrfServiceProvider::generate('register'),
            ]);
        }
    }

    private function checkRegister(): Register
    {
        $post = new Post();
        if (! is_string($post->get('_csrf'))) {
            throw new RegisterException('Une erreur est survenue lors de votre inscription, veuillez réessayer');
        }
        $hasAllFields = $post->has('firstName', 'lastName', 'email', 'password', 'passwordConfirmation', '_csrf');
        $register = $this->registerValidator->validate(
            $post->get('firstName'),
            $post->get('lastName'),
            $post->get('email'),
            $post->get('password'),
            $post->get('passwordConfirmation')
        );
        $checkCsrf = $this->checkCSRF('register', $post->get('_csrf'));
        if (! $hasAllFields || ! $checkCsrf) {
            throw new RegisterException('Une erreur est survenue lors de votre inscription, veuillez réessayer');
        }

        return $register;
    }
}
