<?php

namespace src\Tools;

use DateTime;
use Exception;

class DateTools
{
    /**
     * @throws Exception
     */
    public static function stringToDateTimeConverter(null|string $date): null|DateTime
    {
        if ($date) {
            return new DateTime($date);
        }
        return null;
    }

    public static function dateTimeToStringConverter(null|DateTime $date): null|string
    {
        if ($date) {
            return $date->format('Y-m-d H:m:s');
        }
        return null;
    }
}