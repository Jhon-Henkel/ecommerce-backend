<?php

namespace src\Enums;

class ApiResponseMessageEnum
{
    const REQUIRED_ATTRIBUTES_MISSING = 'Atributos obrigatórios ausentes, revise a documentação!';
    const REGISTER_NOT_INSERTED = 'Não foi possível inserir esse registro!';
    const CREATED_SUCCESS = 'Criado com sucesso!';
    const ATTRIBUTE_ALREADY_EXISTS = 'O seguinte atributo já está cadastrado: ';
    const METHOD_NOT_ALLOWED = 'Método não aceito, revise a documentação!';
    const NOT_FOUND = 'Registro não encontrado!';
}