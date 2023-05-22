### Resources


Examples
```php 


# Initialize router
$router = new \Laventure\Component\Routing\Router();
$router->namespace("App\\Controller\\");
$router->domain('http://localhost:8000');

$router->cacheDir(__DIR__);
$router->middlewareProvides([
    'guest' =>   \App\Middleware\Guest::class,
    'auth'  => \App\Middleware\Authenticated::class,
    'admin'   => \App\Middleware\IsAdmin::class
]);


# Closure
$router->get('/', function () {
    echo "Welcome";
})->name('welcome');


$router->get('/admin/users', [\App\Controller\Admin\UserController::class, 'index'])
    ->name('admin.users.list')->middleware([
        \App\Middleware\IsAdmin::class,
        \App\Middleware\Authenticated::class
    ]);


$router->get('/admin/users/{id}', [\App\Controller\Admin\UserController::class, 'show'])
    ->name('admin.users.show');


$router->get('/admin/users/create', [\App\Controller\Admin\UserController::class, 'create'])
    ->name('admin.users.create');


$router->post('/admin/users', [\App\Controller\Admin\UserController::class, 'store'])
    ->name('admin.users.store');


$router->get('/admin/users/{id}/edit', [\App\Controller\Admin\UserController::class, 'edit'])
       ->name('admin.users.edit');

$router->put('/admin/users/{id}', [\App\Controller\Admin\UserController::class, 'update'])
       ->name('admin.users.update');


$router->delete('/admin/users/{id}', [\App\Controller\Admin\UserController::class, 'destroy'])
       ->name('admin.users.destroy')
       ->middleware([
         \App\Middleware\IsAdmin::class,
         \App\Middleware\Authenticated::class
      ]);

# GROUPS
$router->prefix('api');
$router->module('Api\\');
$router->name('api.');

$prefixes = [
    'path' => 'v1',
    'name' => 'v1.',
    'module' => 'v1',
    'middlewares' => ['auth', \App\Middleware\IsAdmin::class]
];


$router->group($prefixes, function (\Laventure\Component\Routing\Router $router) {

    $router->get('/books', [\App\Controller\Api\v1\BookController::class, 'index'])
           ->name('books.list');

    $router->get('/books/{id}', [\App\Controller\Api\v1\BookController::class, 'index'])
           ->name('books.show');

    $router->get('/books/create', 'BookController@create')
           ->name('books.create');

    $router->get('/books/{id}/edit/{user}', 'BookController@edit')
           ->whereText('user')
           ->name('books.edit');
});


# Web Resources
$router->resource('books', \App\Controller\Api\v1\BookController::class);


$router->group($prefixes, function (\Laventure\Component\Routing\Router $router) {
    $router->resource('books', \App\Controller\Api\v1\BookController::class);
    $router->resource('books', 'BookController');
});

$router->resources([
    'books' => \App\Controller\Api\v1\BookController::class,
    'demo'  => \App\Controller\Admin\UserController::class
]);




# Api Resources

$router->apiResource('books', \App\Controller\Api\v1\BookController::class);


```