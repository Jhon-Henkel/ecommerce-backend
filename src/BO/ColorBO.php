<?php

namespace src\BO;

use src\DAO\ColorDAO;
use src\Enums\TableEnum;
use src\Exceptions\AttributesExceptions\AttributeAlreadyLinkedInProduct;
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

    public function isLinkedToProductByColorId(int $id): bool
    {
        $productBO = new ProductStockBO();
        return (bool)$productBO->countByColorId($id);
    }

    public function deleteById(int $id): void
    {
        if ($this->isLinkedToProductByColorId($id)) {
            throw new AttributeAlreadyLinkedInProduct();
        }
        parent::deleteById($id);
    }
}