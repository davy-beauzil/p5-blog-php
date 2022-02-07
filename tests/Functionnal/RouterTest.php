<?php

declare(strict_types=1);

namespace App\Tests\Functionnal;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RouterTest extends TestCase
{
    /**
     * @test
     */
    public function test()
    {
        static::assertSame(1, 1);
    }
}
