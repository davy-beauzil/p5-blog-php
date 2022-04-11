<?php

declare(strict_types=1);

namespace App\Router;

use App\Controller\AbstractController;
use App\SuperGlobals\Env;
use App\SuperGlobals\Get;
use App\SuperGlobals\Post;
use function array_key_exists;
use function count;
use Exception;
use function in_array;
use function is_string;

class Router
{
    public const GET = ['GET', 'GET'];

    public const POST = ['post', 'POST'];

    public const PUT = ['put', 'PUT'];

    public const PATCH = ['patch', 'PATCH'];

    public const DELETE = ['delete', 'DELETE'];

    public ?Route $route = null;

    /**
     * Extract parameters for GET, POST, PUT, PATCH and DELETE methods.
     */
    public function extractParameters(): void
    {
        if ($this->route !== null) {
            if (! empty(Get::getGlobalSession())) {
                $this->route->getParameters()
                    ->add(Parameters::GET, Get::getGlobalSession())
                ;
            }

            if (in_array($this->route->getMethod(), self::PUT + self::PATCH + self::DELETE, true)) {
                switch ($this->route->getMethod()) {
                    case 'PUT':
                    case 'put':
                        $this->route->getParameters()
                            ->add(Parameters::PUT, Post::getGlobalSession())
                        ;
                        break;
                    case 'PATCH':
                    case 'patch':
                        $this->route->getParameters()
                            ->add(Parameters::PATCH, Post::getGlobalSession())
                        ;
                        break;
                    case 'DELETE':
                    case 'delete':
                        $this->route->getParameters()
                            ->add(Parameters::DELETE, Post::getGlobalSession())
                        ;
                        break;
                }
            } elseif (in_array($this->route->getMethod(), self::POST, true)) {
                $this->route->getParameters()
                    ->add(Parameters::POST, Post::getGlobalSession())
                ;
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
            if (count($queryParameters) > 0) {
                $this->route->getParameters()
                    ->add(Parameters::GET, $queryParameters)
                ;
            }
            $this->extractParameters();
            break;
        }
    }

    /**
     * Call good method controller or redirect to error page.
     */
    public function routing(string $path, string $method): void
    {
        $abstractController = new AbstractController();
        if (str_contains($path, '?')) {
            $path = mb_substr($path, 0, (int) mb_strpos($path, '?'));
        }
        $this->matchRouteAndGetParameters($path, $method);

        if ($this->route === null) {
            $abstractController->render404();
            exit();
        }

        $controller_path = __DIR__ . '/../Controller/' . $this->route->getControllerName() . '.php';

        // Check if controller exists
        if (! file_exists($controller_path)) {
            $abstractController->render404();
        }
        require_once $controller_path;
        $controller = new ('App\Controller\\' . $this->route->getControllerName())();

        // Check if method exists
        if (! method_exists($controller, $this->route->getControllerMethod())) {
            $abstractController->render404();
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
                        unset($parameters[$parameterId]); // ajouté
                    } else {
                        $url = $url . '/' . $value;
                    }
                }
                if (count($parameters) > 0) {
                    $url .= '?' . http_build_query($parameters);
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
            'GET', 'get' => [
                new Route('/', 'GET', 'homepage', 'HomepageController', 'index'),
                new Route('/login', 'GET', 'login', 'LoginController', 'loginIndex'),
                new Route('/logout', 'GET', 'logout', 'LogoutController', 'logout'),
                new Route('/register', 'GET', 'registerIndex', 'RegisterController', 'registerIndex'),
                new Route('/my-account', 'GET', 'myAccount', 'MyAccountController', 'myAccount'),
                new Route(
                    '/my-account/update/password',
                    'GET',
                    'myAccountPasswordUpdate',
                    'MyAccountController',
                    'myAccountPasswordUpdate'
                ),

                new Route('/dashboard/users', 'GET', 'adminUsers', 'UsersDashboardController', 'index'),
                new Route(
                    '/dashboard/user/{id}/delete',
                    'GET',
                    'adminUserDelete',
                    'UsersDashboardController',
                    'delete'
                ),
                new Route(
                    '/dashboard/user/{id}/update',
                    'GET',
                    'adminUserUpdateIndex',
                    'UsersDashboardController',
                    'updateIndex'
                ),

                new Route('/dashboard/articles', 'GET', 'adminArticles', 'ArticlesDashboardController', 'index'),
                new Route(
                    '/dashboard/article/create',
                    'GET',
                    'createArticle',
                    'ArticlesDashboardController',
                    'createIndex'
                ),
                new Route(
                    '/dashboard/article/{id}/delete',
                    'GET',
                    'deleteArticle',
                    'ArticlesDashboardController',
                    'delete'
                ),
                new Route(
                    '/dashboard/article/{id}/update',
                    'GET',
                    'updateArticle',
                    'ArticlesDashboardController',
                    'updateIndex'
                ),
                new Route('/article/{id}', 'GET', 'article', 'ArticleController', 'article'),
                new Route('/user/{id}', 'GET', 'user', 'UserController', 'user'),

                new Route('/dashboard/comments', 'GET', 'comments_manager', 'CommentController', 'manager'),
                new Route('/comment/{comment_id}/valid', 'GET', 'valid_comment', 'CommentController', 'valid'),
                new Route(
                    '/comment/{comment_id}/invalid',
                    'GET',
                    'invalid_comment',
                    'CommentController',
                    'invalid'
                ),
                new Route('/dashboard/comments', 'GET', 'comments_manager', 'CommentController', 'manager'),
                new Route('/comment/{comment_id}/delete', 'GET', 'comment_delete', 'CommentController', 'delete'),
                new Route('/contact', 'GET', 'contact', 'ContactController', 'index'),
                new Route('/dashboard/contacts', 'GET', 'contact_manager', 'ContactController', 'manager'),
                new Route('/contact/{contact_id}/delete', 'GET', 'delete_contact', 'ContactController', 'delete'),
            ],
            'POST', 'post' => [
                new Route('/login', 'POST', 'login', 'LoginController', 'login'),
                new Route('/register', 'POST', 'register', 'RegisterController', 'register'),
                new Route(
                    '/dashboard/article/create',
                    'POST',
                    'createArticle',
                    'ArticlesDashboardController',
                    'create'
                ),
                new Route('/article/{article_id}/comment/new', 'POST', 'add_comment', 'CommentController', 'add'),
                new Route('/contact', 'POST', 'add_contact', 'ContactController', 'contact'),
            ],
            'PUT', 'put' => [
                new Route('/my-account/update', 'PUT', 'updateIdentity', 'MyAccountController', 'updateIdentity'),
                new Route(
                    '/my-account/update/password',
                    'PUT',
                    'updatePassword',
                    'MyAccountController',
                    'updatePassword'
                ),
                new Route(
                    '/dashboard/user/{id}/update',
                    'PUT',
                    'adminUserUpdate',
                    'UsersDashboardController',
                    'update'
                ),
                new Route(
                    '/dashboard/article/{id}/update',
                    'PUT',
                    'updateArticle',
                    'ArticlesDashboardController',
                    'update'
                ),
                new Route('/comment/{comment_id}/update', 'PUT', 'update_comment', 'CommentController', 'update'),
            ],
            default => [],
        };
    }
}
