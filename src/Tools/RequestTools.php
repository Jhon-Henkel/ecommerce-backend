<?php

namespace src\Tools;

class RequestTools
{
    public static function inputGet(string $key): mixed
    {
        return $_GET[$key];
    }

    public static function inputPost(string $key): mixed
    {
        return $_POST[$key];
    }

    public static function inputPhpInput(): ?object
    {
        return json_decode(file_get_contents('php://input'));
    }
}