<?php

namespace src\Enums;

class DocumentEnum
{
    const CPF = 2;

    public static function getDocumentTypesArray(): array
    {
        return array(self::CPF);
    }
}