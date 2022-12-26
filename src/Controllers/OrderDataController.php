<?php

namespace src\Controllers;

use src\BO\OrderDataBO;
use src\Enums\FieldsEnum;
use src\Factory\OrderDataDtoFactory;

class OrderDataController extends BasicController
{
    public OrderDataBO $bo;
    public OrderDataDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new OrderDataBO();
        $this->factory = new OrderDataDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getOrderDataInsertRequiredFields();
    }
}