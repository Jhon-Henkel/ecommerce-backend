<?php

namespace src\BO;

use src\DAO\SizeDAO;
use src\Enums\TableEnum;
use src\Factory\SizeDtoFactory;

class SizeBO extends BasicBO
{
    public SizeDAO $dao;
    public SizeDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new SizeDAO(TableEnum::SIZE);
        $this->factory = new SizeDtoFactory();
    }
}