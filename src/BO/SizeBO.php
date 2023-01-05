<?php

namespace src\BO;

use src\DAO\SizeDAO;
use src\Enums\TableEnum;
use src\Exceptions\AttributesExceptions\AttributeAlreadyLinkedInProduct;
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

    public function isLinkedToProductBySizeId(int $id): bool
    {
        $productBO = new ProductStockBO();
        return (bool)$productBO->countBySizeId($id);
    }

    public function deleteById(int $id): void
    {
        if ($this->isLinkedToProductBySizeId($id)) {
            throw new AttributeAlreadyLinkedInProduct();
        }
        parent::deleteById($id);
    }
}