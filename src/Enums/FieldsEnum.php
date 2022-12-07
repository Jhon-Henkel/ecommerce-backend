<?php

namespace src\Enums;

class FieldsEnum
{
    const CODE = 'code';
    const NAME = 'name';

    public static function getValidateFieldsForBrandPost(): array
    {
        return [self::CODE, self::NAME];
    }
}