<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Router\Route;
use App\Router\Router;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class GenerateUrlTest extends TestCase
{
    protected function setUp(): void
    {
        $mock = $this->createMock(Router::class);
        $mock->method('getRoutes')
            ->willReturn(
                [
                    new Route('/home', 'GET', 'homepage', 'HomepageController', 'index'),
                    new Route('/test', 'GET', 'test', 'HomepageController', 'test'),
                    new Route('/article/{id}', 'GET', 'article', 'HomepageController', 'article'),
                    new Route(
                        '/article/{article_id}/comment/{comment_id}',
                        'GET',
                        'comment',
                        'HomepageController',
                        'article'
                    ),
                ]
            )
        ;
    }

    /**
     * @test
     * @dataProvider generateUrlProvider
     */
    public function testGenerateUrl(
        string $routeName,
        array $parameters,
        string $result,
        ?string $exception = null
    ): void
    {
        $router = new Router();
        try {
            $url = $router->generateUrl($routeName, $parameters);
            static::assertSame($result, $url);
        } catch (Exception $e) {
            static::assertSame($exception, $e->getMessage());
        }
    }

    public function generateUrlProvider(): array
    {
        return [
            ['homepage', [], 'http://localhost:8000/'],
            [
                'article',
                [
                    'id' => 146,
                ],
                'http://localhost:8000/article/146',
            ],
            ['article', [], '', 'Le paramètre id n’a pas été donné pour générer l’url'],
            [
                'comment',
                [
                    'comment_id' => 1,
                ],
                'http://localhost:8000/article/146/comment/1',
                'Le paramètre article_id n’a pas été donné pour générer l’url',
            ],
            [
                'comment',
                [
                    'article_id' => 1,
                ],
                'http://localhost:8000/article/146/comment/1',
                'Le paramètre comment_id n’a pas été donné pour générer l’url',
            ],
            [
                'comment',
                [],
                'http://localhost:8000/article/146/comment/1',
                'Le paramètre article_id n’a pas été donné pour générer l’url',
            ],
        ];
    }
}
