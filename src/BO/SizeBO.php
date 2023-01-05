<?php

namespace src\BO;

use src\DAO\SizeDAO;
use src\Enums\FieldsEnum;
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

    public function deleteById(int $id): void
    {
        if ($this->isLinkedToProductStockByAttributeId(FieldsEnum::SIZE_ID_DB, $id)) {
            throw new AttributeAlreadyLinkedInProduct();
        }
        parent::deleteById($id);
    }
}