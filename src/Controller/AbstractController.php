<?php

declare(strict_types=1);

namespace App\Controller;

use App\Router\Router;
use App\Server\Session;
use App\ServiceProviders\CsrfServiceProvider;
use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AbstractController
{
    /**
     * @param array<string, mixed> $parameters
     */
    public function render(string $view, array $parameters = []): void
    {
        try {
            $this->renderView($view, $parameters);
        } catch (Exception $e) {
            $errorController = new ErrorController();
            $errorController->pageNotFound($e->getMessage());
        }
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function renderView(string $view, array $parameters = []): void
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates');
        if (! $loader->exists($view . '.html.twig')) {
            throw new Exception(sprintf(
                'Une erreur s’est produite lors du rendu avec le fichier %s.html.twig',
                $view
            ));
        }

        // on récupère l'utilisateur courant pour le rendre accessible globalement depuis twig
        $user = Session::get('user');
        if ($user !== null) {
            $parameters['user'] = $user;
        }

        $twig = new Environment($loader, []);
        $template = $twig->load($view . '.html.twig');
        $template->display($parameters);
    }

    public function redirect(string $url, int $status_code = 302): void
    {
        header('Location: ' . $url, true, $status_code);
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function redirectToRoute(string $route_name, array $parameters = [], int $status_code = 302): void
    {
        $router = new Router();
        $this->redirect($router->generateUrl($route_name, $parameters), $status_code);
    }

    public function checkCSRF(string $key, string $csrf_token): bool
    {
        return CsrfServiceProvider::validate($key, $csrf_token);
    }
}
