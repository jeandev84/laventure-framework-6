<?php
namespace Laventure\Component\Message\Http\Convertor;

interface ArrayConvertorInterface
{
    /**
     * Returns data as array
     *
     * @return array
    */
    public function toArray(): array;
}