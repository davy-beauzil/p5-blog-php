<?php

declare(strict_types=1);

namespace App\Controller;

use App\Router\Router;
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
        } catch (Exception) {
            $errorController = new ErrorController();
            $errorController->pageNotFound();
        }
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function renderView(string $view, array $parameters = []): void
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        if (! $loader->exists($view . '.html.twig')) {
            throw new Exception('Une erreur s’est produite lors du rendu.');
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
    public function redirectToRoute(string $route_name, array $parameters, int $status_code = 302): void
    {
        $router = new Router();
        $this->redirect($router->generateUrl($route_name, $parameters), $status_code);
    }
}
