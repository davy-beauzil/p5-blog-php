<?php

declare(strict_types=1);

namespace App\Controller;

use App\Router\Parameters;
use App\ServiceProviders\AuthServiceProvider;
use App\ServiceProviders\CsrfServiceProvider;
use App\Services\LoginService;
use App\Services\RegisterService;
use App\Voters\LoginOrRegisterVoter;
use App\Voters\LogoutVoter;
use App\Voters\Voters;
use function is_array;
use function is_string;

class LoginController extends AbstractController
{
    public function login(Parameters $parameters): void
    {
        if (! Voters::vote(LoginOrRegisterVoter::LOGIN)) {
            $this->redirectToRoute('homepage');
        }

        $result = false;
        $post = $parameters->post;

        if (
            $parameters->has(Parameters::POST, 'email', 'password', '_csrf') &&
            is_string($post['_csrf']) &&
            $this->checkCSRF('login', $post['_csrf'])
        ) {
            $result = LoginService::login($parameters);
            if ($result === true) {
                $this->redirectToRoute('homepage');
            }

            $filler['email'] = $post['email'];
        }

        $this->render('login/login', [
            'errors' => is_array($result) ? $result : null,
            'filler' => $filler ?? null,
            'csrf' => CsrfServiceProvider::generate('login'),
        ]);
    }

    public function register(Parameters $parameters): void
    {
        if (! Voters::vote(LoginOrRegisterVoter::REGISTER)) {
            $this->redirectToRoute('homepage');
        }

        $result = false;

        if ($parameters->has(
            Parameters::POST,
            'first_name',
            'last_name',
            'email',
            'password',
            'password_confirmation'
        )) {
            $result = RegisterService::register($parameters);

            if (! is_array($result)) {
                $this->redirectToRoute('login');
            }
        }

        $this->render('login/register', [
            'errors' => is_array($result) ? $result : null,
        ]);
    }

    public function logout(Parameters $parameters): void
    {
        if (! Voters::vote(LogoutVoter::LOGOUT)) {
            $this->redirectToRoute('homepage');
        }
        AuthServiceProvider::logout();
        $this->redirectToRoute('homepage');
    }
}
