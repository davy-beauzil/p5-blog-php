<?php

declare(strict_types=1);

namespace App\Controller;

use App\Router\Router;
use App\Services\CsrfServiceProvider;
use App\SuperGlobals\Get;
use App\SuperGlobals\Server;
use App\SuperGlobals\Session;
use function count;
use Exception;
use function is_string;
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
            $this->render404();
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

    public function render404(?string $error = null): void
    {
        $this->render('404', [
            'error' => $error,
        ]);
        exit();
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

    /**
     * @param array<string, mixed> $parameters
     */
    public function redirectToLastPage(array $parameters): void
    {
        $url = Server::get('HTTP_REFERER');
        if (is_string($url)) {
            if (str_contains($url, '?')) {
                $url = mb_substr($url, 0, (int) mb_strpos($url, '?'));
            }
            if (count($parameters) > 0) {
                $url = sprintf('%s?%s', $url, http_build_query($parameters));
            }
            $this->redirect($url);
        } else {
            $this->redirectToRoute('homepage');
        }
    }

    public function checkCSRF(string $key, string $csrf_token): bool
    {
        return CsrfServiceProvider::validate($key, $csrf_token);
    }
}
