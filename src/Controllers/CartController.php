<?php

namespace src\Controllers;

use src\BO\CartBO;
use src\Enums\FieldsEnum;
use src\Factory\CartDtoFactory;

class CartController extends BasicController
{
    public CartBO $bo;
    public CartDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new CartBO();
        $this->factory = new CartDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getCartInsertRequiredFields();
    }
}