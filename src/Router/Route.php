<?php

declare(strict_types=1);

namespace App\Router;

class Route
{
    private Parameters $parameters;

    public function __construct(
        private string $path,
        private string $method,
        private string $name,
        private string $controller_name,
        private string $controller_method,
    ) {
        $this->parameters = new Parameters();
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getControllerName(): string
    {
        return $this->controller_name;
    }

    public function setControllerName(string $controller_name): void
    {
        $this->controller_name = $controller_name;
    }

    public function getControllerMethod(): string
    {
        return $this->controller_method;
    }

    public function setControllerMethod(string $controller_method): void
    {
        $this->controller_method = $controller_method;
    }

    public function getParameters(): Parameters
    {
        return $this->parameters;
    }
}
