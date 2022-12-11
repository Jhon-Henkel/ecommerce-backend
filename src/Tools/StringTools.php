<?php

namespace src\Tools;

class StringTools
{
    public static function onlyNumbers(string $string): string
    {
        return (string)preg_replace("/[^0-9]/", "", $string);
    }

    public function priceBR($value): string
    {
        return 'R$ ' . preg_replace('/\./', ',', $value);
    }
}