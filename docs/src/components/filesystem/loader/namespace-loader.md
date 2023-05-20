### NamespaceLoader 

Example
```
$locator = new \Laventure\Component\Filesystem\Locator\FileLocator(__DIR__);

$namespaceLoader = new \Laventure\Component\Filesystem\Loader\NamespaceLoader($locator);

$namespaceLoader->addNamespaces([
    "Framework\\" => "src/",
    "App\\" => "app/",
]);


dump($namespaceLoader->loadClass(\Framework\Component\HTML\Form::class));
dd($namespaceLoader->loadClass(\App\Controller\Api\v1\BookController::class));
```