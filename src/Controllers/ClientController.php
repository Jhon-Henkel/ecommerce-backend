<?php

namespace src\Controllers;

use src\BO\ClientBO;
use src\Enums\FieldsEnum;
use src\Factory\ClientDtoFactory;

class ClientController extends BasicController
{
    public ClientBO $bo;
    public ClientDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new ClientBO();
        $this->factory = new ClientDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getClientRequiredFields();
    }
}