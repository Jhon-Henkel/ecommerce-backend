<?php

namespace src\Api;

use src\Enums\ApiResponseMessageEnum;
use src\Enums\HttpStatusCodeEnum;

/**
 * @codeCoverageIgnore
 */
class Response
{
    public static function render(int $code, mixed $print): void
    {
        http_response_code($code);
        exit(json_encode($print));
    }

    public static function renderRequiredAttributesMissing(): void
    {
        self::render(
            HttpStatusCodeEnum::HTTP_BAD_REQUEST,
            ApiResponseMessageEnum::REQUIRED_ATTRIBUTES_MISSING
        );
    }

    public static function renderAttributeAlreadyLinkedInProduct(): void
    {
        self::render(
            HttpStatusCodeEnum::HTTP_BAD_REQUEST,
            ApiResponseMessageEnum::ATTRIBUTE_ALREADY_LINKED_IN_PRODUCT
        );
    }

    public static function renderAttributeAlreadyExists(string $attribute): void
    {
        self::render(
            HttpStatusCodeEnum::HTTP_CONFLICT,
            ApiResponseMessageEnum::ATTRIBUTE_ALREADY_EXISTS . $attribute
        );
    }

    public static function renderAttributeAlreadyExistsInThisCart(string $attribute): void
    {
        self::render(
            HttpStatusCodeEnum::HTTP_CONFLICT,
            ApiResponseMessageEnum::ATTRIBUTE_ALREADY_EXISTS_IN_THIS_CART . $attribute
        );
    }

    public static function renderMethodNotAllowed(): void
    {
        self::render(
            HttpStatusCodeEnum::HTTP_METHOD_NOT_ALLOWED,
            ApiResponseMessageEnum::METHOD_NOT_ALLOWED
        );
    }

    public static function renderNotFound(): void
    {
        self::render(
            HttpStatusCodeEnum::HTTP_NOT_FOUND,
            ApiResponseMessageEnum::NOT_FOUND
        );
    }

    public static function renderAttributeNotFound(string $attribute): void
    {
        self::render(
            HttpStatusCodeEnum::HTTP_NOT_FOUND,
            ApiResponseMessageEnum::ATTRIBUTE_NOT_FOUND . $attribute
        );
    }

    public static function renderInvalidFieldValue(string $field): void
    {
        $message = ApiResponseMessageEnum::INVALID_VALUE . $field;
        self::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }

    public static function renderCartOpenForThisClient(): void
    {
        $message = ApiResponseMessageEnum::CART_OPEN_FOR_THIS_CLIENT;
        self::render(HttpStatusCodeEnum::HTTP_CONFLICT, $message);
    }

    public static function renderInvalidUseForField(string $field): void
    {
        $message = ApiResponseMessageEnum::INVALID_USE_FOR_THIS_FIELD . $field;
        $message .= '. ' . ApiResponseMessageEnum::MAX_USAGES_OR_INATIVE;
        self::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }

    public static function renderCartDontAllowInsertItens(): void
    {
        $message = ApiResponseMessageEnum::CART_DINT_ALLOW_INSERT_ITEM;
        self::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }

    public static function renderOutOfStockItem(int $id = null): void
    {
        $message = ApiResponseMessageEnum::ITEM_OUT_OF_STOCK;
        if ($id) {
            $message .= 'Stock: ' . $id;
        }
        self::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }

    public static function renderInsufficientStockBalanceItem(int $id = null): void
    {
        $message = ApiResponseMessageEnum::ITEM_INSUFFICIENT_STOCK;
        if ($id) {
            $message .= 'Stock: ' . $id;
        }
        self::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }

    public static function renderItemHaveOrder(): void
    {
        $message = ApiResponseMessageEnum::ITEM_HAVE_ORDER;
        self::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }

    public static function renderCartHaveOrder(): void
    {
        $message = ApiResponseMessageEnum::CART_HAVE_ORDER;
        self::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }

    public static function renderCartDontHaveItens(): void
    {
        $message = ApiResponseMessageEnum::CART_DONT_HAVE_ITENS;
        self::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }
}