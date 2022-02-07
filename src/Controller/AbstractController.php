<?php

namespace App\Controller;

use App\Router\Router;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class AbstractController
{

    /**
     * @param array<string, mixed> $parameters
     */
    public function render(string $view, array $parameters = []): void
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        if(!$loader->exists($view . '.html.twig')){
            dd('Le template est introuvable, il faut être redirigé vers une page 404');
            return;
        }
        $twig = new Environment($loader, []);
        $template = $twig->load($view . '.html.twig');
        echo $template->render($parameters);
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