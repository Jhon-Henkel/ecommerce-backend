<?php

namespace src\Tools;

class DateTools
{
    public static function dateTimeConverter(string $date): \DateTime
    {
        return new \DateTime($date);
    }

    public static function dateTimeToString(\DateTime $date): string
    {
        return $date->format('Y-m-d');
    }
}