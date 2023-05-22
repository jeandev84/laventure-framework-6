### Route Matching


Example
```php 

$router = new \Laventure\Component\Routing\Router();
$router->namespace("App\\Controller\\");
$router->domain('http://localhost:8000');

$router->cacheDir(__DIR__);
$router->middlewareProvides([
    'guest' =>   \App\Middleware\Guest::class,
    'auth'  => \App\Middleware\Authenticated::class,
    'admin'   => \App\Middleware\IsAdmin::class
]);



$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestPath   = $_SERVER['REQUEST_URI'];


# Closure
$router->get('/', function () {
    echo "Welcome";
})->name('welcome');


if (! $route = $router->match($requestMethod, $requestPath)) {
    dd('Route not found');
}
    
dump($route);

try {

    $router->dispatchRoute($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

} catch (Exception $e) {

    dump($e->getMessage());
}

```