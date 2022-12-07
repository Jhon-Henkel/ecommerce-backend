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

    public static function RenderRequiredAtributesMissing(): void
    {
        self::Render(HttpStatusCodeEnum::HTTP_DAB_REQUEST,ApiResponseMessageEnum::REQUIRED_ATRIBUTES_MISSING);
    }
}