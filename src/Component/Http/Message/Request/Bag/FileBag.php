<?php
namespace Laventure\Component\Http\Message\Request\Bag;

use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Message\Request\File\UploadedFile;
use Laventure\Component\Http\Message\Request\File\UploadedFileConvertor;


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

    use UploadedFileConvertor;


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
     * @param $name
     *
     * @param UploadedFile $file
     *
     * @return $this
    */
    private function setUploadedFile($name, UploadedFile $file): static
    {
        $this->params[$name] = $file;

        return $this;
    }
}