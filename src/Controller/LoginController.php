<?php

declare(strict_types=1);

namespace App\Controller;

use App\Router\Parameters;
use App\Server\Post;
use App\Services\RegisterService;
use function is_array;

class LoginController extends AbstractController
{
    public function login(Parameters $parameters): void
    {
//        if(!Post::has('email', 'password')){
//            var_dump('Un ou plusieurs champs sont manquants');
//        }
//        $mail = Post::get('email');
//        $password = Post::get('password');
//        var_dump($mail, $password);
        ////        $this->service->login($mail, $password);
        $this->render('login/login');
    }

    public function register(Parameters $parameters): void
    {
        $result = false;

        if ($parameters->hasParameters(Parameters::POST, 'first_name', 'last_name', 'email', 'password')) {
            $result = RegisterService::register($parameters);

            if (! is_array($result)) {
                $this->redirectToRoute('login', []);
            }
        }

        $this->render('login/register', [
            'errors' => is_array($result) ? $result : null,
        ]);
    }

    public function logout(Parameters $parameters): void
    {
    }
}
