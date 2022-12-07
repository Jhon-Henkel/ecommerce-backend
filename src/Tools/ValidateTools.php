<?php

namespace src\Tools;

class ValidateTools
{
    public static function validateParamsFieldsInArray(array $paramsFields, array $validate): bool
    {
        foreach ($paramsFields as $paramField) {
            if (!array_key_exists($paramField, $validate)) {
                return false;
            }
        }
        return true;
    }
}