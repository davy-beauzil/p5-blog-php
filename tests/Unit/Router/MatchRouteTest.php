<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Router\Router;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class MatchRouteTest extends TestCase
{
    /**
     * @dataProvider routeProvider
     * @test
     */
    public function testMatchRoute(string $path, string $method, ?string $routeName)
    {
        $router = new Router();
        $router->routing($path, $method);
        static::assertSame($router->route->getName(), $routeName);
    }

    public function routeProvider()
    {
        return [
            ['/', 'GET', 'homepage'],
            ['/article/1', 'GET', 'article'],
            ['/article/2/comment/4', 'GET', 'comment'],
        ];
    }
}
