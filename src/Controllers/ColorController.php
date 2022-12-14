<?php

namespace src\Controllers;

use src\BO\ColorBO;
use src\Enums\FieldsEnum;
use src\Factory\ColorDtoFactory;

class ColorController extends BasicController
{
    public ColorBO $bo;
    public ColorDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new ColorBO();
        $this->factory = new ColorDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getBasicRequiredFields();
    }
}