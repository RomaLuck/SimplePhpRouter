<?php

namespace Romaluck\PhpRouter\Middleware;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface RequestHandlerInterface
{
    public function handle(Request $request): Response;
}