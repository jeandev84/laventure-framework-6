### Route Group


1. Add route group
```php 
$router = new \Laventure\Component\Routing\Router();
$router->namespace("App\\Controller\\");
$router->domain('http://localhost:8000');
$router->patterns(['id' => '\d+']);

# REST or CRUD
$prefixes = [
    'path' => 'api/',
    'name' => 'api.',
    'middlewares' => [\App\Middleware\Guest::class]
];

$router->group($prefixes, function (\Laventure\Component\Routing\Router $router) {
    $router->get('/books', [\App\Controller\Api\v1\BookController::class, 'index'])
        ->name('books.list');

    $router->get('/books/{id}', [\App\Controller\Api\v1\BookController::class, 'index'])
        ->name('books.show');
});



$router->get('/test', [\App\Controller\FrontController::class, 'index'])->name('test');



dd($router->getRoutes());

```


2. Add some prefixes
```php 

$router = new \Laventure\Component\Routing\Router();
$router->namespace("App\\Controller\\");
$router->domain('http://localhost:8000');
$router->patterns(['id' => '\d+']);

$router->prefix('api');
$router->name('api');
$router->middlewares([\App\Middleware\Guest::class]);


# REST or CRUD
$prefixes = [
    'path' => 'v1',
    'name' => 'v1.'
];

$router->group($prefixes, function (\Laventure\Component\Routing\Router $router) {
    $router->get('/books', [\App\Controller\Api\v1\BookController::class, 'index'])
        ->name('books.list');

    $router->get('/books/{id}', [\App\Controller\Api\v1\BookController::class, 'index'])
        ->name('books.show');
});



$router->get('/test', [\App\Controller\FrontController::class, 'index'])->name('test');



dd($router->getRoutes());

```