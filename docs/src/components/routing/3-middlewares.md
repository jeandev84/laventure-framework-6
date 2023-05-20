### Middlewares storage


Example
````php 
$router = new \Laventure\Component\Routing\Router();
$router->namespace("App\\Controller\\");
$router->domain('http://localhost:8000');
$router->patterns(['id' => '\d+']);

$router->prefix('api');
$router->name('api');
$router->middlewares([
 'guest' =>   \App\Middleware\Guest::class,
 'auth'  => \App\Middleware\Authenticated::class,
 'admin'   => \App\Middleware\IsAdmin::class
]);


# REST or CRUD
$prefixes = [
    'path' => 'v1',
    'name' => 'v1.',
    'middlewares' => ['auth', \App\Middleware\IsAdmin::class]
];

$router->group($prefixes, function (\Laventure\Component\Routing\Router $router) {
    $router->get('/books', [\App\Controller\Api\v1\BookController::class, 'index'])
        ->name('books.list');

    $router->get('/books/{id}', [\App\Controller\Api\v1\BookController::class, 'index'])
        ->name('books.show');
});



$router->get('/test', [\App\Controller\FrontController::class, 'index'])
      ->name('test')
      ->middleware('guest')
;

```