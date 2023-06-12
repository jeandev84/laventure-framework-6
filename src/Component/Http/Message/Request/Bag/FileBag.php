<?php
namespace Laventure\Component\Http\Message\Request\Bag;

use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Message\Request\File\UploadedFile;


/**
 * @FileBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\cUrlRequest\Bag
*/
class FileBag extends ParameterBag
{

    /**
     * FileBag constructor.
     * @param array $params
    */
    public function __construct(array $params = [])
    {
        parent::__construct($this->convertFiles($params));
    }




    /**
     * @param UploadedFile[] $params
     *
     * @return $this
    */
    public function merge(array $params): static
    {
        foreach ($params as $key => $file) {
            $this->set($key, $file);
        }

        return $this;
    }




    /**
     * @param $name
     *
     * @param $value
     *
     * @return $this
    */
    public function set($name, $value): static
    {
        return $this->setUploadedFile($name, $value);
    }





    /**
     * @return UploadedFile[]
    */
    public function all(): array
    {
        return parent::all();
    }




    /**
     * @param string $name
     *
     * @param $default
     *
     * @return UploadedFile|null
    */
    public function get(string $name, $default = null): ?UploadedFile
    {
        return parent::get($name, $default);
    }





    /**
     * @param array $files
     * @return array
    */
    private function convertFiles(array $files): array
    {
        $resolvedFiles = $this->transformInformationFiles($files);

        $uploadedFiles = [];

        foreach ($resolvedFiles as $name => $items) {
            foreach ($items as $file) {
                $uploadedFile = $this->createUploadedFileFromArray($file);
                if ($uploadedFile->isUploaded()) {
                    $uploadedFiles[$name][] = $uploadedFile;
                }
            }
        }

        return $uploadedFiles;
    }




    /**
     * @param array $files
     * @return array
    */
    private function transformInformationFiles(array $files): array
    {
        $resolved = [];

        foreach ($files as $name => $params) {
            if (is_array($params['name'])) {
                foreach ($params as $attribute => $file) {
                    foreach ($file as $index => $value) {
                        $resolved[$name][$index][$attribute] = $value;
                    }
                }
            }else{
                $resolved[$name][] = $params;
            }
        }

        return $resolved;
    }




    /**
     * @param array $file
     *
     * @return UploadedFile
    */
    private function createUploadedFileFromArray(array $file): UploadedFile
    {
        return new UploadedFile(
            $file['name'],
            $file['full_path'],
            $file['type'],
            $file['tmp_name'],
            $file['error'],
            $file['size']
        );
    }




    /**
     * @param $name
     *
     * @param UploadedFile $file
     *
     * @return $this
    */
    private function setUploadedFile($name, UploadedFile $file): static
    {
        $this->config[$name] = $file;

        return $this;
    }
}