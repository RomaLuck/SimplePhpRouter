<?php

declare(strict_types=1);

namespace Romaluck\PhpRouter\Router;

use Romaluck\PhpRouter\Middleware\MiddlewarePipeline;
use Romaluck\PhpRouter\Middleware\RequestHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
    public function __construct(private Request $request)
    {
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function match(Route ...$routes): Response
    {
        $method = $this->getRequest()->getMethod();
        $path = rtrim($this->getRequest()->getPathInfo(), '/');

        foreach ($routes as $route) {
            if ($method === $route->getMethod() && $path === $route->getPath()) {
                $handler = new RequestHandler($route->getController());
                $middlewarePipeline = new MiddlewarePipeline($handler);

                $middlewares = $route->getMiddlewares();
                foreach ($middlewares as $middleware) {
                    $middlewarePipeline->add($middleware);
                }
                return $middlewarePipeline->handle($this->getRequest());
            }
        }
        return new RedirectResponse('/404');
    }
}