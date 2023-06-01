<?php
namespace Laventure\Component\Http\Convertor;

interface ArrayConvertorInterface
{
    /**
     * Returns data as array
     *
     * @return array
    */
    public function toArray(): array;
}