<?php

namespace src\BO;

use src\Enums\FieldsEnum;
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

    public function deleteById(int $id): void
    {
        if ($this->isLinkedToProductStockByAttributeId(FieldsEnum::BRAND_ID_DB, $id)) {
            throw new AttributeAlreadyLinkedInProduct();
        }
        parent::deleteById($id);
    }
}