<?php

namespace src\BO;

use src\DAO\ColorDAO;
use src\DTO\ColorDTO;
use src\Factory\ColorDtoFactory;

class ColorBO extends BasicBO
{
    public ColorDAO $dao;
    public ColorDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new ColorDAO('color');
        $this->factory = new ColorDtoFactory();
    }

    public function insert(ColorDTO $color): void
    {
        $columns = 'color_code, color_name';
        $values = ':code, :name';
        $params = array(
            'code' => $color->getCode(),
            'name' => $color->getName(),
        );
        $this->dao->insert($columns, $values, $params);
    }

    public function update(ColorDTO $color)
    {
        $values = 'color_code = :code, color_name = :name';
        $where = 'color_id = :id';
        $params = array(
            'id' => $color->getId(),
            'code' => $color->getCode(),
            'name' => $color->getName(),
        );
        $this->dao->update($values, $where, $params);
    }
}