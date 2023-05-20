### ClassLoader


Example
```php 

$locator = new \Laventure\Component\Filesystem\Locator\FileLocator(__DIR__);
$classLoader = new \Laventure\Component\Filesystem\Loader\ClassLoader($locator);

dd($classLoader->loadClass(SomeClass::class));

```