<?php

namespace src\BO;

use src\DAO\AddressDAO;
use src\Enums\TableEnum;
use src\Factory\AddressDtoFactory;

class AddressBO extends BasicBO
{
    public AddressDAO $dao;
    public AddressDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new AddressDAO(TableEnum::ADDRESS);
        $this->factory = new AddressDtoFactory();
    }
}