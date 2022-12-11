<?php

namespace src\BO;

use src\DAO\ColorDAO;
use src\Enums\TableEnum;
use src\Factory\ColorDtoFactory;

class ColorBO extends BasicBO
{
    public ColorDAO $dao;
    public ColorDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new ColorDAO(TableEnum::COLOR);
        $this->factory = new ColorDtoFactory();
    }
}