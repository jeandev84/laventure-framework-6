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


2. Advanced route group 
```php 

$router = new \Laventure\Component\Routing\Router();
$router->namespace("App\\Controller\\");
$router->domain('http://localhost:8000');
$router->patterns(['id' => '\d+']);

$router->prefix('api');
$router->name('api.');

$router->middlewares([
 'guest' =>   \App\Middleware\Guest::class,
 'auth'  => \App\Middleware\Authenticated::class,
 'admin'   => \App\Middleware\IsAdmin::class
]);


# REST or CRUD
$prefixes = [
    'path' => 'v1',
    'name' => 'v1.',
    'module' => 'Api\\',
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



$router->get('/test', [\App\Controller\FrontController::class, 'index'])
      ->name('test')
      ->middleware('guest')
;



dd($router->getCollection()->getRoutesByName());

```


3. Add list routes
```php 

$router = new \Laventure\Component\Routing\Router();
$router->namespace("App\\Controller\\");
$router->domain('http://localhost:8000');
$router->patterns(['id' => '\d+']);

$router->prefix('api');
$router->module('Api\\');
$router->name('api.');

$router->middlewares([
 'guest' =>   \App\Middleware\Guest::class,
 'auth'  => \App\Middleware\Authenticated::class,
 'admin'   => \App\Middleware\IsAdmin::class
]);


# REST or CRUD
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



$router->get('/test', [\App\Controller\FrontController::class, 'index'])
      ->name('test')
      ->middleware('guest')
;



$router->get('/admin/users', [\App\Controller\Admin\UserController::class, 'index'])
       ->name('admin.users.list')->middleware([
           \App\Middleware\IsAdmin::class,
           \App\Middleware\Authenticated::class
      ]);


$router->get('/admin/users/{id}', [\App\Controller\Admin\UserController::class, 'show'])
       ->name('admin.users.show');


$router->get('/admin/users', [\App\Controller\Admin\UserController::class, 'create'])
       ->name('admin.users.create');


$router->post('/admin/users', [\App\Controller\Admin\UserController::class, 'store'])
       ->name('admin.users.store');


$router->get('/admin/users/{id}', [\App\Controller\Admin\UserController::class, 'edit'])
       ->name('admin.users.edit');

$router->put('/admin/users/{id}', [\App\Controller\Admin\UserController::class, 'update'])
       ->name('admin.users.update');


$router->delete('/admin/users/{id}', [\App\Controller\Admin\UserController::class, 'destroy'])
       ->name('admin.users.destroy')
       ->middleware([
         \App\Middleware\IsAdmin::class,
         \App\Middleware\Authenticated::class
      ]);



dump($router->getCollection()->getRoutesByMethod());
dump($router->getCollection()->getRoutesByController());
dump($router->getCollection()->getRoutesByName());
dump($router->getRoutes());


```