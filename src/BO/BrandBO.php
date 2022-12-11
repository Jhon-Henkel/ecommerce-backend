<?php

namespace src\BO;

use src\Enums\TableEnum;
use src\Factory\BrandDtoFactory;
use src\DAO\BrandDAO;

class BrandBO extends BasicBO
{
    public BrandDAO $dao;
    public BrandDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new BrandDAO(TableEnum::BRAND);
        $this->factory = new BrandDtoFactory();
    }
}