<?php

namespace src\BO;

use src\DAO\SizeDAO;
use src\DTO\SizeDTO;
use src\Factory\SizeDtoFactory;

class SizeBO extends BasicBO
{
    public SizeDAO $dao;
    public SizeDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new SizeDAO('size');
        $this->factory = new SizeDtoFactory();
    }

    public function insert(SizeDTO $size): void
    {
        $columns = 'size_code, size_name';
        $values = ':code, :name';
        $params = array(
            'code' => $size->getCode(),
            'name' => $size->getName(),
        );
        $this->dao->insert($columns, $values, $params);
    }

    public function update(SizeDTO $size)
    {
        $values = 'size_code = :code, size_name = :name';
        $where = 'size_id = :id';
        $params = array(
            'id' => $size->getId(),
            'code' => $size->getCode(),
            'name' => $size->getName(),
        );
        $this->dao->update($values, $where, $params);
    }
}