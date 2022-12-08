<?php

namespace src\Api;

use src\Enums\ApiResponseMessageEnum;
use src\Enums\HttpStatusCodeEnum;

class Response
{
    public static function Render(int $code, mixed $print): void
    {
        http_response_code($code);
        exit(json_encode($print));
    }

    public static function RenderRequiredAttributesMissing(): void
    {
        self::Render(
            HttpStatusCodeEnum::HTTP_DAB_REQUEST,
            ApiResponseMessageEnum::REQUIRED_ATTRIBUTES_MISSING
        );
    }

    public static function RenderAttributeAlreadyExists(string $attribute): void
    {
        self::Render(
            HttpStatusCodeEnum::HTTP_CONFLICT,
            ApiResponseMessageEnum::ATTRIBUTE_ALREADY_EXISTS . $attribute
        );
    }

    public static function RenderMethodNotAllowed(): void
    {
        self::Render(
            HttpStatusCodeEnum::HTTP_METHOD_NOT_ALLOWED,
            ApiResponseMessageEnum::METHOD_NOT_ALLOWED
        );
    }

    public static function RenderNotFound(): void
    {
        self::Render(
            HttpStatusCodeEnum::HTTP_NOT_FOUND,
            ApiResponseMessageEnum::NOT_FOUND
        );
    }
}