### Route Generator


```php 
$router = new \Laventure\Component\Routing\Router();
$router->namespace("App\\Controller\\");
$router->domain('http://localhost:8000');
$router->cache(__DIR__);
$router->middlewares([
    'guest' =>   \App\Middleware\Guest::class,
    'auth'  => \App\Middleware\Authenticated::class,
    'admin'   => \App\Middleware\IsAdmin::class
]);


$router->get('/admin/users/{id}', [\App\Controller\Admin\UserController::class, 'show'])
       ->name('admin.users.show');
       
echo $router->generate('admin.users.show', ['id' => 3]);

```