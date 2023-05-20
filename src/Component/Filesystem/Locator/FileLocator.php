<?php
namespace Laventure\Component\Filesystem\Locator;


/**
 * @inheritDoc
*/
class FileLocator implements FileLocatorInterface
{

    /**
     * FileLoader constructor.
     *
     * @param string $root
    */
    public function __construct(protected string $root)
    {
        $this->root = realpath($this->normalizeDirectory($root));
    }




    /**
     * @inheritDoc
    */
    public function locateFile(string $filename): string
    {
         return join(DIRECTORY_SEPARATOR, [$this->root, $this->normalizeFile($filename)]);
    }




    /**
     * @param string $filename
     *
     * @return bool
    */
    public function exists(string $filename): bool
    {
         return file_exists($this->locateFile($filename));
    }




    /**
     * Normalize namespace base directory
     *
     * @param string $path
     *
     * @return string
    */
    public function normalizeDirectory(string $path): string
    {
        return rtrim($path, DIRECTORY_SEPARATOR);
    }




    /**
     * @param string $path
     *
     * @return string
    */
    public function normalizeFile(string $path): string
    {
         return str_replace(["\\", "/"], DIRECTORY_SEPARATOR, trim($path, '\\/'));
    }
}