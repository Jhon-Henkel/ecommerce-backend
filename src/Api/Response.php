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

    public static function renderAttributeAlreadyExists(string $attribute): void
    {
        self::render(
            HttpStatusCodeEnum::HTTP_CONFLICT,
            ApiResponseMessageEnum::ATTRIBUTE_ALREADY_EXISTS . $attribute
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
        Response::render(HttpStatusCodeEnum::HTTP_BAD_REQUEST, $message);
    }

    public static function renderCartOpenForThisClient(): void
    {
        $message = ApiResponseMessageEnum::CART_OPEN_FOR_THIS_CLIENT;
        self::render(HttpStatusCodeEnum::HTTP_CONFLICT, $message);
    }
}