<?php
namespace Laventure\Component\Http\Request\Bag;

use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Request\File\UploadedFile;
use Laventure\Component\Http\Request\File\UploadedFileConvertor;


/**
 * @FileBag
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package Laventure\Component\Http\Request\Bag
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
}