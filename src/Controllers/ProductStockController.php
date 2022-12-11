<?php

namespace src\Controllers;

use src\BO\ProductStockBO;
use src\Enums\FieldsEnum;
use src\Factory\ProductStockDtoFactory;

class ProductStockController extends BasicController
{
    public ProductStockBO $bo;
    public ProductStockDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new ProductStockBO();
        $this->factory = new ProductStockDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getProductStockAllFields();
    }
}