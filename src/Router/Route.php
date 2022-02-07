<?php

declare(strict_types=1);

namespace App\Router;

class Route
{
    /**
     * @param array<string, mixed>|null $parameters
     */
    public function __construct(
        private string $path = '',
        private string $method = 'GET',
        private string $name = '',
        private string $controller_name = '',
        private string $controller_method = '',
        private ?array $parameters = null,
    ) {
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

    /**
     * @return array<string, mixed>|null
     */
    public function getParameters(): ?array
    {
        return $this->parameters;
    }

    /**
     * @param array<string, mixed> $parameters
     */
    public function addParameters(array $parameters): void
    {
        $this->parameters = array_merge($this->parameters ?? [], $parameters);
    }
}
