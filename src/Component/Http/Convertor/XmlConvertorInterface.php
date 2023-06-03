<?php
namespace Laventure\Component\Message\Http\Convertor;

interface XmlConvertorInterface
{
    /**
     * Returns data as xml
     *
     * @return string
     */
    public function toXml(): string;
}