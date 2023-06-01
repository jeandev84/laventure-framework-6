<?php
namespace Laventure\Component\Http\Convertor;

interface JsonConvertorInterface
{
    /**
     * Returns data as json
     *
     * @return string
    */
    public function toJson(): string;
}