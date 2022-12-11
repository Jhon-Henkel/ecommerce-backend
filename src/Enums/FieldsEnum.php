<?php

namespace src\Enums;

class FieldsEnum
{
    const CATEGORY_ID_JSON = 'categoryId';
    const CATEGORY_ID_DB = 'category_id';
    const GROSS_WEIGHT = "grossWeight";
    const DESCRIPTION = 'description';
    const COLOR_ID_JSON = "colorId";
    const BRAND_ID_JSON = "brandId";
    const COLOR_ID_DB = "color_id";
    const BRAND_ID_DB = "brand_id";
    const SIZE_ID_JSON = "sizeId";
    const SIZE_ID_DB = "size_id";
    const QUANTITY = "quantity";
    const HEIGHT = "height";
    const LENGTH = "length";
    const STOCK = 'stock';
    const PRICE = "price";
    const WIDTH = "width";
    const NAME = 'name';
    const CODE = 'code';
    const ID = 'id';

    public static function getBasicValidateFields(): array
    {
        return array(self::CODE, self::NAME);
    }

    public static function getProductAllFields(): array
    {
        return array(self::CODE, self::NAME, self::DESCRIPTION, self::CATEGORY_ID_JSON);
    }

    public static function getProductAllFieldsForPost(): array
    {
        return array_merge(self::getProductAllFields(), array(self::STOCK));
    }

    public static function getProductStockAllFields(): array
    {
        return array(
            self::CODE,
            self::NAME,
            self::QUANTITY,
            self::COLOR_ID_JSON,
            self::SIZE_ID_JSON,
            self::BRAND_ID_JSON,
            self::PRICE,
            self::WIDTH,
            self::HEIGHT,
            self::LENGTH,
            self::GROSS_WEIGHT
        );
    }

    public static function getProductStockFieldsValuesShouldExistsInDb(): array
    {
        return array(self::COLOR_ID_DB, self::SIZE_ID_DB, self::BRAND_ID_DB);
    }

    public static function getProductFieldsValuesShouldExistsInDb():array
    {
        return array(self::CATEGORY_ID_DB);
    }
}