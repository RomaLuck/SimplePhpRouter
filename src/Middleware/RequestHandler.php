<?php

declare(strict_types=1);

namespace Romaluck\PhpRouter\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestHandler implements RequestHandlerInterface
{
    public function __construct(private string $controller)
    {
    }

    public function handle(Request $request): Response
    {
        return call_user_func(new $this->controller(), $request);
    }
}