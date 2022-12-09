<?php

namespace src\Enums;

class FieldsEnum
{
    const CODE = 'code';
    const NAME = 'name';
    const ID = 'id';

    public static function getValidateBrandFields(): array
    {
        return [self::CODE, self::NAME];
    }

    public static function getValidateCategoryFields(): array
    {
        return [self::CODE, self::NAME];
    }
}