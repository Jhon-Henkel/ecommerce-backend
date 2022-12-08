<?php

namespace src\Enums;

class ApiResponseMessageEnum
{
    const REQUIRED_ATTRIBUTES_MISSING = 'Atributos obrigatórios ausentes!';
    const REGISTER_NOT_INSERTED = 'Não foi possível inserir esse registro!';
    const CREATED_SUCCESS = 'Criado com sucesso!';
    const ATTRIBUTE_ALREADY_EXISTS = 'O seguinte atributo já está cadastrado: ';
}