<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\ErrorController;
use App\Server\Env;
use function array_key_exists;
use Exception;
use function in_array;
use function is_string;

class Router
{
    public ?Route $route = null;

    /**
     * Extract parameters for POST, PUT, PATCH and DELETE methods.
     */
    public function extractParameters(): void
    {
        if ($this->route !== null) {
            if (in_array($this->route->getMethod(), ['PUT', 'PATCH', 'DELETE'], true)) {
                if (file_get_contents('php://input')) {
                    /** @var array<string, mixed> $parameters */
                    $parameters = json_decode(file_get_contents('php://input'), true);
                    $this->route->addParameters($parameters);
                }
            } elseif ($this->route->getMethod() === 'POST') {
                $this->route->addParameters($_POST);
            }
        }
    }

    /**
     * Find good route and extract query and request parameters.
     */
    public function matchRouteAndGetParameters(string $path, string $method): void
    {
        $routes = $this->getRoutes($method);
        $exploded_path = explode('/', $path);
        unset($exploded_path[0]);

        $queryParameters = [];

        /** @var Route $route */
        foreach ($routes as $route) {
            $route_path = $route->getPath();
            $exploded_route_path = explode('/', $route_path);
            unset($exploded_route_path[0]);

            $exploded_path_to_compare = $exploded_path;

            foreach ($exploded_route_path as $key => $value) {
                // Si l'élément commence par "{" et termine par "}"
                if (preg_match('/^\{[a-zA-Z0-9_]*\}$/', $value)) {
                    $exploded_path_to_compare[$key] = $value;
                    $queryParameters[mb_substr($value, 1, -1)] = $exploded_path[$key];
                }
            }

            if ($exploded_route_path !== $exploded_path_to_compare) {
                $queryParameters = [];
                continue;
            }
            $this->route = $route;
            $this->route->addParameters($queryParameters);
            $this->extractParameters();
            break;
        }
    }

    /**
     * Call good method controller or redirect to error page.
     */
    public function routing(string $path, string $method): void
    {
        $errorController = new ErrorController();
        $this->matchRouteAndGetParameters($path, $method);

        if ($this->route === null) {
            $errorController->pageNotFound();
            exit();
        }

        $controller_path = __DIR__ . '/../Controller/' . $this->route->getControllerName() . '.php';

        // Check if controller exists
        if (! file_exists($controller_path)) {
            $errorController->pageNotFound();
            exit();
        }
        require_once $controller_path;
        $controller = new ('App\Controller\\' . $this->route->getControllerName())();

        // Check if method exists
        if (! method_exists($controller, $this->route->getControllerMethod())) {
            $errorController->pageNotFound();
            exit();
        }
        $controller->{$this->route->getControllerMethod()}($this->route->getParameters());
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function generateUrl(string $routeName, array $parameters): string
    {
        $env = new Env();
        $env_var = 'DOMAIN';
        $url = $env->get($env_var);
        if (! is_string($url)) {
            throw new Exception(sprintf('La variable d’environnement "%s" n’est pas au bon format', $env_var));
        }

        $routes = $this->getRoutes('GET');
        /** @var Route $route */
        foreach ($routes as $route) {
            if ($route->getName() === $routeName) {
                $exploded_route_path = explode('/', $route->getPath());
                unset($exploded_route_path[0]);

                foreach ($exploded_route_path as $value) {
                    if (preg_match('/^\{[a-zA-Z0-9_]*\}$/', $value)) {
                        $parameterId = mb_substr($value, 1, -1);
                        if (! array_key_exists($parameterId, $parameters)) {
                            throw new Exception(sprintf(
                                'Le paramètre %s n’a pas été donné pour générer l’url',
                                $parameterId
                            ));
                        }
                        $url = $url . '/' . $parameters[$parameterId];
                    } else {
                        $url = $url . '/' . $value;
                    }
                }
                break;
            }
        }

        return $url;
    }

    /**
     * Return routes of the method.
     *
     * @return array<Route|mixed>
     */
    public function getRoutes(string $method = 'GET'): array
    {
        return match ($method) {
            'GET' => [
                new Route('/', 'GET', 'homepage', 'HomepageController', 'index'),
                new Route('/test', 'GET', 'test', 'HomepageController', 'test'),
                new Route('/article/{id}', 'GET', 'article', 'HomepageController', 'article'),
                new Route(
                    '/article/{article_id}/comment/{comment_id}',
                    'GET',
                    'comment',
                    'HomepageController',
                    'article'
                ),
            ],
            'POST' => [new Route('/login', 'POST', 'login', 'LoginController', 'login')],
            'PUT' => [new Route('/article/{id}', 'PUT', 'article', 'HomepageController', 'article')],
            default => [],
        };
    }

    public function addRoute(Route $route, string $method): void
    {
    }
}
