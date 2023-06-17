<?php
namespace Laventure\Component\Http\Message\Request\File;

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

        foreach ($files as $name => $fileArray) {
            if (is_array($fileArray['name'])) {
                foreach ($fileArray as $attribute => $file) {
                    foreach ($file as $index => $value) {
                        $resolved[$name][$index][$attribute] = $value;
                    }
                }
            }else{
                $resolved[$name][] = $fileArray;
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
}