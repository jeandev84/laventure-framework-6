<?php
namespace Laventure\Component\Http\Message\Request\File;

use Laventure\Component\Http\Message\Request\Contract\UploadedFileInterface;
use Laventure\Component\Http\Message\Request\File\Exception\UploadedFileException;


/**
 * @UploadedFile
 *
 * @link https://www.php-fig.org/psr/psr-7/
 *
 * @link https://www.php.net/manual/en/function.is-uploaded-file.php
 *
 * @link https://www.php.net/manual/en/features.file-upload.errors.php
 *
 * @link https://www.php.net/manual/en/features.file-upload.errors.php
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Message\cUrlRequest\File
*/
class UploadedFile extends File implements UploadedFileInterface
{


    use UploadedFileErrorMessage;


    /**
     * @var array
    */
    protected $mimeTypes = [];



    /**
     * @var array
    */
    protected $errors = [];




    /**
     * @param $name
     *
     * @param $mime
     *
     * @param $path
     *
     * @param $temp
     *
     * @param $error
     *
     * @param $size
    */
    public function __construct($name, $path, $mime, $temp, $error, $size)
    {
        parent::__construct($name, $path, $mime, $temp, $error, $size);
    }




    /**
     * @return bool
    */
    public function isOk(): bool
    {
        return $this->error === UPLOAD_ERR_OK;
    }





    /**
     * @return bool
    */
    public function isUploaded(): bool
    {
         return is_uploaded_file($this->temp);
    }




    /**
     * @return string
    */
    public function getErrorMessage(): string
    {
        return $this->getCodeToMessage($this->error);
    }




    /**
     * @inheritDoc
    */
    public function moveTo($targetPath): bool
    {
        if (! $this->isOk()) {
            throw new UploadedFileException($this->getErrorMessage(), $this->error);
        }

        $dirname = dirname($targetPath);

        if(! is_dir($dirname)) {
            @mkdir($dirname, 0777, true);
        }

        return move_uploaded_file($this->temp, $targetPath);
    }




    /**
     * Upload file
     *
     * @param string $targetPath
     *
     * @param string|null $filename
     *
     * @return string
     *
     * @throws UploadedFileException
     */
    public function move(string $targetPath, string $filename = null): string
    {
          if (! $filename) {
              $filename  = sha1(mt_rand()) . "File" . $this->getExtension();
          }

          $uploadedFilePath = UploadedFile . phprtrim($targetPath, DIRECTORY_SEPARATOR) . $filename;

          if (! $this->moveTo($uploadedFilePath)) {
              throw new UploadedFileException($this->error);
          }

          return $uploadedFilePath;
    }




    /**
     * @inheritDoc
    */
    public function getClientFilename()
    {
        return $this->getOriginalName();
    }




    /**
     * @inheritDoc
     */
    public function getClientMediaType()
    {
        return $this->getMimeType();
    }



    /**
     * @inheritDoc
    */
    public function getStream()
    {
        // TODO: Implement getStream() method.
    }
}