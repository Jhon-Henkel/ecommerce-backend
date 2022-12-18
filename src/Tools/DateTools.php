<?php

namespace src\Tools;

class DateTools
{
    public static function stringToDateTimeConverter(string $date): \DateTime
    {
        return new \DateTime($date);
    }

    public static function dateTimeToStringConverter(\DateTime $date): string
    {
        return $date->format('Y-m-d');
    }
}