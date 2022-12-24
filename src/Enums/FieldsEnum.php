<?php

namespace src\Enums;

class FieldsEnum
{
    const DISCOUNT_TYPE_JSON = 'discountType';
    const DOCUMENT_TYPE_JSON = 'documentType';
    const GROSS_WEIGHT_JSON = 'grossWeight';
    const GIFT_CART_ID_JSON = 'giftCardId';
    const CATEGORY_ID_JSON = 'categoryId';
    const MAX_USAGES_JSON = 'maxUsages';
    const PRODUCT_ID_JSON = 'productId';
    const BIRTH_DATE_JSON = 'birthDate';
    const CLIENT_ID_JSON = 'clientId';
    const COLOR_ID_JSON = 'colorId';
    const PRODUCT_ID_DB = 'product_id';
    const BRAND_ID_JSON = 'brandId';
    const ZIP_CODE_JSON = 'zipCode';
    const ORDER_DONE_DB = 'order_done';
    const CLIENT_ID_DB = 'client_id';
    const SIZE_ID_JSON = 'sizeId';
    const DESCRIPTION = 'description';
    const PASSWORD = 'password';
    const QUANTITY = 'quantity';
    const DOCUMENT = 'document';
    const DISCOUNT = 'discount';
    const DISTRICT = 'district';
    const ADDRESS = 'address';
    const STREET = 'street';
    const HEIGHT = 'height';
    const STATUS = 'status';
    const LENGTH = 'length';
    const EMAIL = 'email';
    const PRICE = 'price';
    const STATE = 'state';
    const WIDTH = 'width';
    const CITY = 'city';
    const NAME = 'name';
    const CODE = 'code';
    const ID = 'id';

    public static function getBasicRequiredFields(): array
    {
        return array(self::CODE, self::NAME);
    }

    public static function getProductRequiredFields(): array
    {
        return array(self::CODE, self::NAME, self::DESCRIPTION, self::CATEGORY_ID_JSON);
    }

    public static function getProductStockRequiredFields(): array
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
            self::GROSS_WEIGHT_JSON
        );
    }

    public static function getClientRequiredFields(): array
    {
        return array(
            self::NAME,
            self::DOCUMENT_TYPE_JSON,
            self::DOCUMENT,
            self::EMAIL,
            self::BIRTH_DATE_JSON,
            self::PASSWORD
        );
    }

    public static function getClientRequiredFieldsMustNotExistsInDb(): array
    {
        return array(
            self::DOCUMENT,
            self::EMAIL
        );
    }

    public static function getAddressRequiredFieldsInClientInsert(): array
    {
        return array(
            self::STREET,
            self::ZIP_CODE_JSON,
            self::DISTRICT,
            self::CITY,
            self::STATE
        );
    }

    public static function getAddressRequiredFields(): array
    {
        return array_merge(
            self::getAddressRequiredFieldsInClientInsert(),
            array(self::CLIENT_ID_JSON,)
        );
    }

    public static function getGiftCardInsertRequiredFields(): array
    {
        return array(
            self::CODE,
            self::DISCOUNT_TYPE_JSON,
            self::DISCOUNT,
            self::MAX_USAGES_JSON,
            self::STATUS
        );
    }

    public static function getCartInsertRequiredFields(): array
    {
        return array(
            self::CLIENT_ID_JSON
        );
    }
}