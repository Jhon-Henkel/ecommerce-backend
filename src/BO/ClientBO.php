<?php

namespace src\BO;

use src\DAO\ClientDAO;
use src\Enums\TableEnum;
use src\Factory\ClientDtoFactory;

class ClientBO extends BasicBO
{
    public ClientDAO $dao;
    public ClientDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new ClientDAO(TableEnum::CLIENT);
        $this->factory = new ClientDtoFactory();
    }
}