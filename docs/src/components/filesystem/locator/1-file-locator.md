### FileLocator


Example
```php 
$fileLocator = new \Laventure\Component\Filesystem\Locator\FileLocator(__DIR__.'/../');

echo $fileLocator->locateFile('cache/something.txt');

echo file_get_contents($fileLocator->locateFile('cache/something.txt')); */

echo file_get_contents($fileLocator->locateFile('templates/index.html'));

```