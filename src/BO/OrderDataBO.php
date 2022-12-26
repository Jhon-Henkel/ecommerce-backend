<?php

namespace src\BO;

use src\DAO\OrderDataDAO;
use src\Enums\TableEnum;
use src\Factory\OrderDataDtoFactory;

class OrderDataBO extends BasicBO
{
    public OrderDataDAO $dao;
    public OrderDataDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new OrderDataDAO(TableEnum::ORDER_DATA);
        $this->factory = new OrderDataDtoFactory();
    }
}