<?php

namespace src\Enums;

class FieldsEnum
{
    const DOCUMENT_TYPE_JSON = 'documentType';
    const GROSS_WEIGHT_JSON = 'grossWeight';
    const DESCRIPTION_JSON = 'description';
    const CATEGORY_ID_JSON = 'categoryId';
    const PRODUCT_ID_JSON = 'productId';
    const BIRTH_DATE_JSON = 'birthDate';
    const CATEGORY_ID_DB = 'category_id';
    const CLIENT_ID_JSON = 'clientId';
    const COLOR_ID_JSON = 'colorId';
    const PRODUCT_ID_DB = 'product_id';
    const PASSWORD_JSON = 'password';
    const QUANTITY_JSON = 'quantity';
    const DOCUMENT_JSON = 'document';
    const DISTRICT_JSON = 'district';
    const BRAND_ID_JSON = 'brandId';
    const ZIP_CODE_JSON = 'zipCode';
    const ADDRESS_JSON = 'address';
    const SIZE_ID_JSON = 'sizeId';
    const STREET_JSON = 'street';
    const HEIGHT_JSON = 'height';
    const LENGTH_JSON = 'length';
    const COLOR_ID_DB = 'color_id';
    const BRAND_ID_DB = 'brand_id';
    const SIZE_ID_DB = 'size_id';
    const EMAIL_JSON = 'email';
    const STOCK_JSON = 'stock';
    const PRICE_JSON = 'price';
    const STATE_JSON = 'state';
    const WIDTH_JSON = 'width';
    const CITY_JSON = 'city';
    const NAME_JSON = 'name';
    const CODE_JSON = 'code';
    const ID_JSON = 'id';

    public static function getBasicRequiredFields(): array
    {
        return array(self::CODE_JSON, self::NAME_JSON);
    }

    public static function getProductRequiredFields(): array
    {
        return array(self::CODE_JSON, self::NAME_JSON, self::DESCRIPTION_JSON, self::CATEGORY_ID_JSON);
    }

    public static function getProductAllFieldsForPost(): array
    {
        return array_merge(self::getProductRequiredFields(), array(self::STOCK_JSON));
    }

    public static function getProductStockRequiredFields(): array
    {
        return array(
            self::CODE_JSON,
            self::NAME_JSON,
            self::QUANTITY_JSON,
            self::COLOR_ID_JSON,
            self::SIZE_ID_JSON,
            self::BRAND_ID_JSON,
            self::PRICE_JSON,
            self::WIDTH_JSON,
            self::HEIGHT_JSON,
            self::LENGTH_JSON,
            self::GROSS_WEIGHT_JSON
        );
    }

    public static function getProductStockAllFieldsToInsert(): array
    {
        return array_merge(self::getProductStockRequiredFields(), array(self::PRODUCT_ID_JSON));
    }

    public static function getProductStockFieldsValuesShouldExistsInDb(): array
    {
        return array(self::COLOR_ID_DB, self::SIZE_ID_DB, self::BRAND_ID_DB);
    }

    public static function getProductFieldsValuesShouldExistsInDb():array
    {
        return array(self::CATEGORY_ID_DB);
    }

    public static function getClientRequiredFields(): array
    {
        return array(
            self::NAME_JSON,
            self::DOCUMENT_TYPE_JSON,
            self::DOCUMENT_JSON,
            self::EMAIL_JSON,
            self::BIRTH_DATE_JSON,
            self::PASSWORD_JSON
        );
    }

    public static function getClientRequiredFieldsMustNotExistsInDb(): array
    {
        return array(
            self::DOCUMENT_JSON,
            self::EMAIL_JSON
        );
    }

    public static function getAddressRequiredFieldsInClientInsert(): array
    {
        return array(
            self::STREET_JSON,
            self::ZIP_CODE_JSON,
            self::DISTRICT_JSON,
            self::CITY_JSON,
            self::STATE_JSON
        );
    }

    public static function getAddressRequiredFields(): array
    {
        return array_merge(
            self::getAddressRequiredFieldsInClientInsert(),
            array(self::CLIENT_ID_JSON,)
        );
    }
}