### Router


1. Map routes
```php 


# add closure action
$route1 = (new \Laventure\Component\Routing\Route\Route(['GET'], '/', function () {
    return "Welcome to my home page";
}))->domain('http://localhost:8000')->name('home');


# add controller and action handler
$route2 = (new \Laventure\Component\Routing\Route\Route(['GET'], '/about', [
    \App\Controller\FrontController::class,
    'about'
]))->domain('http://localhost:8000')
    ->name('about');


# add multiple routes
$route3 = (new \Laventure\Component\Routing\Route\Route(['GET', 'POST'], '/contact', [
    \App\Controller\FrontController::class,
    'contact'
]))->domain('http://localhost:8000')
    ->name('contact');


dump([$route1, $route2, $route3]);



# Initialize router
$router = new \Laventure\Component\Routing\Router();
$router->domain('http://localhost:8000');
$router->patterns([]);


# Add routes
$router->get('/', function () {
    return "Welcome to my home page";
})->name('home');

$router->get('/about', [\App\Controller\FrontController::class, 'about'])
       ->name('about');

$router->get('/contact', [\App\Controller\FrontController::class, 'contact'])
       ->name('contact');



dd($router->getRoutes());
```



2. Add CRUD Routes
```php 

$router->get('/', function () {
     return "Welcome!";
})->name('welcome')->middleware(\App\Middleware\Guest::class);


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



$router->get('/', [\App\Controller\FrontController::class, 'index'])
     ->name('welcome')->middleware(\App\Middleware\Guest::class);

$router->get('/demo', [\App\Controller\FrontController::class, 'contact'])
      ->name('demo')->middleware(\App\Middleware\Guest::class);



dd($router->getCollection()->getRoutesByName());
```
