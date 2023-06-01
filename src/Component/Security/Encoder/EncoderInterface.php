<?php
namespace Laventure\Component\Security\Encoder;

interface EncoderInterface
{
    /**
     * @param $string
     *
     * @return mixed
    */
    public function encode($string);



    /**
     * @param $string
     *
     * @return mixed
    */
    public function decode($string);
}