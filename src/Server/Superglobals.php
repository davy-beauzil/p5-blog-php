<?php

declare(strict_types=1);

namespace App\Server;

class Superglobals
{
    public static function get(): Get
    {
        return new Get();
    }

    public static function post(): Post
    {
        return new Post();
    }

    public static function env(): Env
    {
        return new Env();
    }

    public static function session(): Session
    {
        return new Session();
    }

    public static function server(): Server
    {
        return new Server();
    }
}
