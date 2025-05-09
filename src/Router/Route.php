<?php

declare(strict_types=1);

namespace Romaluck\PhpRouter\Router;

use Romaluck\PhpRouter\Middleware\MiddlewareInterface;

class Route
{
    private array $middlewares = [];

    private function __construct(private string $method, private string $path, private string $controller)
    {
    }

    public static function get(string $path, string $controller): self
    {
        return new self('GET', $path, $controller);
    }

    public static function post(string $path, string $controller): self
    {
        return new self('POST', $path, $controller);
    }

    public function addMiddleware(MiddlewareInterface $middleware): self
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    /**
     * @return MiddlewareInterface[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): string
    {
        return $this->controller;
    }
}