<?php

namespace src\BO;

use src\Enums\TableEnum;
use src\Exceptions\AttributesExceptions\AttributeAlreadyLinkedInProduct;
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

    public function isLinkedToProductByBrandId(int $id): bool
    {
        $productBO = new ProductStockBO();
        return (bool)$productBO->countByBrandId($id);
    }

    public function deleteById(int $id): void
    {
        if ($this->isLinkedToProductByBrandId($id)) {
            throw new AttributeAlreadyLinkedInProduct();
        }
        parent::deleteById($id);
    }
}