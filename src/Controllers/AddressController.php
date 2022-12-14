<?php

namespace src\Controllers;

use src\BO\AddressBO;
use src\Enums\FieldsEnum;
use src\Factory\AddressDtoFactory;

class AddressController
{
    public AddressBO $bo;
    public AddressDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new AddressBO();
        $this->factory = new AddressDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getAddressRequiredFields();
    }
}