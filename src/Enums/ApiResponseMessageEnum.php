<?php

namespace src\Enums;

class ApiResponseMessageEnum
{
    const REQUIRED_ATTRIBUTES_MISSING = 'Atributos obrigatórios ausentes, revise a documentação!';
    const ATTRIBUTE_ALREADY_EXISTS = 'O seguinte atributo já está cadastrado: ';
    const METHOD_NOT_ALLOWED = 'Método não aceito, revise a documentação!';
    const NOT_FOUND = 'Registro não encontrado!';
    const ATTRIBUTE_NOT_FOUND = 'O id do seguinte atributo não foi encontrado: ';
    const FATHER_CATEGORY_NOT_FOUND = 'Categoria pai não encontrada!';
    const INVALID_VALUE = 'O valor para o seguinte campo é inválido: ';
    const CART_OPEN_FOR_THIS_CLIENT= 'Já existe carrinho sem pedido finalizado para este cliente!';
}