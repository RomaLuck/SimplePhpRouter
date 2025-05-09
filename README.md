## Table of contents

* [General info](#general-info)
* [Installation](#installation)
* [Usage](#usage)
* [Routing](#routing)
* [Controller](#controller)
* [Middleware](#middleware)

## General info

This is a simple router for PHP

## Requirements

* PHP >= 8.2
* Symfony/http-foundation >= 7.2

## Installation

```
composer require romaluck/php-router
```

## Usage

```php
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

$request = Request::createFromGlobals();

// Create Router instance
$router = new Romaluck\PhpRouter\Router($request);

// Define routes
// ...

// Run it!
$router->send();
```

## Routing

```php
$router->match(
    Route::get('/', IndexController::class)->addMiddleware(new AuthMiddleware()),
    Route::post('/upload', UploadImageController::class),
)
```

## Controller

```php
//Controller should implement ControllerInterface
class IndexController implements ControllerInterface
{
    public function __invoke(Request $request): Response
```

## Middleware

```php
use Romaluck\PhpRouter\Middleware\MiddlewareInterface;
use Romaluck\PhpRouter\Middleware\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//Middleware should implement MiddlewareInterface
class AuthMiddleware implements MiddlewareInterface
{

    public function process(Request $request, RequestHandlerInterface $handler): Response
```
