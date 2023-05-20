### Router


1. Map routes
```php 
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


```