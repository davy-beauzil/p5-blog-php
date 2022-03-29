<?php

declare(strict_types=1);

namespace App\Controller;

use App\Router\Router;
use App\Services\CsrfServiceProvider;
use App\SuperGlobals\Get;
use App\SuperGlobals\Session;
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

        $parameters['app']['user'] = Session::get('user'); /* @phpstan-ignore-line */
        $parameters['app']['error'] = Get::get('error'); /* @phpstan-ignore-line */
        $parameters['app']['success'] = Get::get('success'); /** @phpstan-ignore-line */
        $twig = new Environment($loader, []);
        $template = $twig->load($view . '.html.twig');
        $template->display($parameters);
    }

    public function redirect(string $url, int $status_code = 302): void
    {
        header('Location: ' . $url, true, $status_code);
        exit();
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
