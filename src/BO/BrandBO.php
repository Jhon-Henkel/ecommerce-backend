<?php

namespace src\BO;

use src\DTO\BrandDTO;
use src\Factory\BrandDtoFactory;
use src\DAO\BrandDAO;

class BrandBO extends BasicBO
{
    public BrandDAO $dao;
    public BrandDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new BrandDAO('brand');
        $this->factory = new BrandDtoFactory();
    }

    public function insert(BrandDTO $brand): void
    {
        $columns = 'brand_code, brand_name';
        $values = ':code, :name';
        $params = array(
            'code' => $brand->getCode(),
            'name' => $brand->getName(),
        );
        $this->dao->insert($columns, $values, $params);
    }

    public function update(BrandDTO $brand)
    {
        $values = 'brand_code = :code, brand_name = :name';
        $where = 'brand_id = :id';
        $params = array(
            'id' => $brand->getId(),
            'code' => $brand->getCode(),
            'name' => $brand->getName(),
        );
        $this->dao->update($values, $where, $params);
    }
}