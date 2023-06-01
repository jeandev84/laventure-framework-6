<?php
namespace Laventure\Component\Http\Request\Body;

class ParsedBody extends RequestBody
{

    /**
     * @return string
    */
    public function getContent(): string
    {
        return $this->__toString() ?? '';
    }



    /**
     * @return mixed
    */
    public function getData(): mixed
    {
        parse_str($this->getContent(), $data);

        return $data;
    }




    /**
     * @return false|string
    */
    public function asJson(): bool|string
    {
        $content = $this->getContent();

        if (json_last_error()) {
            trigger_error(json_last_error_msg());
        }

        return json_encode($content, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
    }




    /**
     * @return mixed
    */
    public function asArray(): mixed
    {
        $content = $this->asJson();

        if(! $data =  json_decode($content, true)) {
            return [];
        }

        return $data;
    }





    /**
     * @return bool
    */
    public function isEmpty(): bool
    {
        return is_null($this->getContent());
    }
}