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
 * @package Laventure\Component\Http\Message\Request\Bag
*/
class FileBag extends ParameterBag
{

    /**
     * FileBag constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        parent::__construct($params);

        $this->replace($params);
    }




    /**
     * @param array $files
     */
    public function replace(array $files = [])
    {
        $this->params = [];
        $this->add($files);
    }





    /**
     * @param array $files
     */
    public function add(array $files = [])
    {
        $files = $this->convertFiles($files);

        foreach ($files as $key => $file) {
            $this->set($key, $file);
        }
    }





    /**
     * @param string $name
     *
     * @param $value
     *
     * @return $this
     */
    public function set($name, $value): static
    {
        if (!\is_array($value) && ! $value instanceof UploadedFile) {
            throw new \InvalidArgumentException('An uploaded file must be an array or an instance of UploadedFile.');
        }

        return parent::set($name, $value);
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
    public function convertFiles(array $files): array
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
    public function transformInformationFiles(array $files): array
    {
        $fileParams = [];

        foreach ($files as $name => $fileArray) {
            if (is_array($fileArray['name'])) {
                foreach ($fileArray as $attribute => $file) {
                    foreach ($file as $index => $value) {
                        $fileParams[$name][$index][$attribute] = $value;
                    }
                }
            }else{
                $fileParams[$name][] = $fileArray;
            }
        }

        return $fileParams;
    }




    /**
     * @param array $file
     *
     * @return UploadedFile
    */
    public function createUploadedFileFromArray(array $file): UploadedFile
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
}