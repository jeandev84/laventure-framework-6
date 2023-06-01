<?php
namespace Laventure\Component\Http\Convertor;

interface XmlConvertorInterface
{
    /**
     * Returns data as xml
     *
     * @return string
     */
    public function toXml(): string;
}