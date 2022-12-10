<?php

namespace src\Controllers;

use src\BO\CategoryBO;
use src\Enums\FieldsEnum;
use src\Factory\CategoryDtoFactory;

class CategoryController extends BasicController
{
    public CategoryBO $bo;
    public CategoryDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new CategoryBO();
        $this->factory = new CategoryDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getValidateCategoryFields();
    }
}