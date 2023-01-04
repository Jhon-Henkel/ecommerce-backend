<?php

namespace src\Enums;

class ApiResponseMessageEnum
{
    const REQUIRED_ATTRIBUTES_MISSING = 'Atributos obrigatórios ausentes, revise a documentação!';
    const ATTRIBUTE_ALREADY_EXISTS = 'O seguinte atributo já está cadastrado: ';
    const ATTRIBUTE_ALREADY_EXISTS_IN_THIS_CART = 'O seguinte atributo já está cadastrado neste carrinho: ';
    const METHOD_NOT_ALLOWED = 'Método não aceito, revise a documentação!';
    const NOT_FOUND = 'Registro não encontrado!';
    const ATTRIBUTE_NOT_FOUND = 'O id do seguinte atributo não foi encontrado: ';
    const INVALID_VALUE = 'O valor para o seguinte campo é inválido: ';
    const CART_OPEN_FOR_THIS_CLIENT = 'Já existe carrinho sem pedido finalizado para este cliente!';
    const INVALID_USE_FOR_THIS_FIELD = 'Uso inválido para o campo: ';
    const MAX_USAGES_OR_INATIVE = 'O item pode ter atingido o máximo de utilizações ou está inativo!';
    const CART_DINT_ALLOW_INSERT_ITEM = 'Este carrinho não permite inserir itens!';
    const ITEM_OUT_OF_STOCK = 'Este item não tem estoque!';
    const ITEM_INSUFFICIENT_STOCK = 'Este item não tem estoque suficiente!';
    const ITEM_HAVE_ORDER = 'Impossível alterar. Este item já tem pedido finalizado!';
    const CART_HAVE_ORDER = 'Impossível alterar. Este carrinho já tem pedido finalizado!';
    const CART_DONT_HAVE_ITENS = 'Este carrinho não tem itens vinculados!';
    const INVALID_GIFT_CARD_IN_THIS_CART = 'Gift Card inválido aplicado no carrinho';
    const INVALID_VALUE_GIFT_CARD_FOR_THIS_CART = 'giftCard do carrinho. O valor de desconto não pode ser maior que o valor do carrinho';
    const ATTRIBUTE_ALREADY_LINKED_IN_PRODUCT = 'Este atributo já está vinculado com um produto!';
}