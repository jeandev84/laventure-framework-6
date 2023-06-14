<?php
namespace Laventure\Component\Http\Message\Client\Service\Stream\Option;

interface StreamOptionInterface
{
    /**
     * @return array
    */
    public function getParameters(): array;
}