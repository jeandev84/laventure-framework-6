### NamespaceLoader 

1. Example with adding namespaces
```php 
$locator = new \Laventure\Component\Filesystem\Locator\FileLocator(__DIR__);

$namespaceLoader = new \Laventure\Component\Filesystem\Loader\NamespaceLoader($locator);

$namespaceLoader->addNamespaces([
    "Framework\\" => "src/",
    "App\\" => "app/",
]);


dump($namespaceLoader->loadClass(\Framework\Component\HTML\Form::class));
dd($namespaceLoader->loadClass(\App\Controller\Api\v1\BookController::class));
```


2. Example with mapping namespaces from constructor
```php 
$locator = new \Laventure\Component\Filesystem\Locator\FileLocator(__DIR__);

$namespaceLoader = new \Laventure\Component\Filesystem\Loader\NamespaceLoader($locator, [
    "Framework\\" => "src/",
    "App\\" => "app/",
]);

dump($namespaceLoader->loadClass(\Framework\Component\HTML\Form::class));
dump($namespaceLoader->loadClass(\App\Controller\Api\v1\BookController::class));

$classLoader = new \Laventure\Component\Filesystem\Loader\ClassLoader($locator);
```