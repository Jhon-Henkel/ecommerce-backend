<?php

namespace src\Tools;

class StringTools
{
    public static function onlyNumbers(string $string): string
    {
        return (string)preg_replace("/[^0-9]/", "", $string);
    }

    public static function priceBR(float $value): string
    {
        return 'R$ ' . preg_replace('/\./', ',', $value);
    }

    public static function replaceSpacesInDashes(string $string): string
    {
        return preg_replace('/ /', '-', $string);
    }

    public static function dateTimeConverter(string $date): \DateTime
    {
        return new \DateTime($date);
    }

    public static function dateTimeToString(\DateTime $date): string
    {
        return $date->format('Y-m-d');
    }
}