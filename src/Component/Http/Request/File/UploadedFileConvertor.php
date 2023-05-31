<?php
namespace Laventure\Component\Http\Request\File;


/**
 * @UploadedFileConvertor
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\File
*/
trait UploadedFileConvertor
{

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
                $uploadedFiles[$name][] = new UploadedFile($file['name'], $file['type'], $file['tmp_name'], $file['error'], $file['size']);
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
}