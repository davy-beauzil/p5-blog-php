<?php

declare(strict_types=1);

namespace App\Router;

use function array_key_exists;
use function is_array;

class Parameters
{
    public const GET = 'get';

    public const POST = 'post';

    public const PUT = 'put';

    public const PATCH = 'patch';

    public const DELETE = 'delete
    ';

    /**
     * @var array<string, mixed>
     */
    public array $get = [];

    /**
     * @var array<string, mixed>
     */
    public array $post = [];

    /**
     * @var array<string, mixed>
     */
    public array $patch = [];

    /**
     * @var array<string, mixed>
     */
    public array $put = [];

    /**
     * @var array<string, mixed>
     */
    public array $delete = [];

    /**
     * @param array<string, mixed> $parameters
     */
    public function addParameters(string $method, array $parameters): void
    {
        if (is_array($this->{$method})) {
            $this->{$method} = array_merge($this->{$method}, $parameters);
        }
    }

    public function hasParameters(string $method, string ...$keys): bool
    {
        if (is_array($this->{$method})) {
            foreach ($keys as $key) {
                if (! array_key_exists($key, $this->{$method})) {
//                    dump('La clé ' . $key . ' n’existe pas');
//                    dd($this->{$method});
                    return false;
                }
            }

            return true;
        }

        return false;
    }
}
