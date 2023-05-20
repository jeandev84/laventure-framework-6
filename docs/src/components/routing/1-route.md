### Route 


1. Example 
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

```