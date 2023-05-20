### SPL Autoloader classes


Example
```php 

$locator = new \Laventure\Component\Filesystem\Locator\FileLocator(__DIR__);

$namespaceLoader = new \Laventure\Component\Filesystem\Loader\NamespaceLoader($locator, [
    "Framework\\" => "src/",
    "App\\" => "app/",
]);

$autoloader = new \Laventure\Component\Filesystem\Loader\SplAutoLoaderClass($namespaceLoader);
$autoloader->register();

$form = new \Framework\Component\HTML\Form();

dd($form);

```