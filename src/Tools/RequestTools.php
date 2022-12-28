<?php

namespace src\Tools;

class RequestTools
{
    public static function inputGet(string $key): mixed
    {
        return $_GET[$key] ?? null;
    }

    public static function inputPost(string $key): mixed
    {
        return $_POST[$key] ?? null;
    }

    public static function inputServer(string $key): mixed
    {
        return $_SERVER[$key] ?? null;
    }

    /**
     * @return object|null
     * @codeCoverageIgnore
     */
    public static function inputPhpInput(): ?object
    {
        return json_decode(file_get_contents('php://input')) ?? null;
    }
}