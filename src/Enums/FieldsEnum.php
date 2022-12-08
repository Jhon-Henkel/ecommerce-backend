<?php

namespace src\Enums;

class FieldsEnum
{
    const CODE = 'code';
    const NAME = 'name';
    const ID = 'id';

    public static function getValidateFields(): array
    {
        return [self::CODE, self::NAME];
    }
}