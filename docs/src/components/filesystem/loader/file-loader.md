### FileLoader 


Example
```php 
$locator = new \Laventure\Component\Filesystem\Locator\FileLocator(__DIR__.'/../');

$loader = new \Laventure\Component\Filesystem\Loader\FileLoader($locator);

$loader->loadFile('config/services.php');

$config = $loader->loadFile('config/app.php');
dump($config);

dump($loader->loadFile('config/services.php'));
```