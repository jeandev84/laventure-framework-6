<?php
namespace Laventure\Component\Message\Http\Convertor;

interface JsonConvertorInterface
{
    /**
     * Returns data as json
     *
     * @return string
    */
    public function toJson(): string;
}