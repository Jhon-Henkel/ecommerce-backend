<?php

namespace src\Controllers;

use src\BO\SizeBO;
use src\Enums\FieldsEnum;
use src\Factory\SizeDtoFactory;

class SizeController extends BasicController
{
    public SizeBO $bo;
    public SizeDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new SizeBO();
        $this->factory = new SizeDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getBasicValidateFields();
    }
}