<?php

namespace src\Tools;

use src\Exceptions\DatabaseExceptions\QueryTypeException;

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

    public static function validateQueryType(string $type, string $query): void
    {
        if (!preg_match('/^' . $type . '/i', $query)){
            throw new QueryTypeException('Base de dados não é do tipo ' . $type);
        }
    }

    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}