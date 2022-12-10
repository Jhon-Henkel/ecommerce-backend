<?php

namespace src\Controllers;

use src\BO\BrandBO;
use src\Enums\FieldsEnum;
use src\Factory\BrandDtoFactory;

class BrandController extends BasicController
{
    public BrandBO $bo;
    public BrandDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new BrandBO();
        $this->factory = new BrandDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getBasicValidateFields();
    }
}