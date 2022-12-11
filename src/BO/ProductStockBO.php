<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\ProductStockDAO;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use src\Factory\ProductStockDtoFactory;

class ProductStockBO extends BasicBO
{
    public ProductStockDAO $dao;
    public ProductStockDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new ProductStockDAO(TableEnum::PRODUCT_STOCK);
        $this->factory = new ProductStockDtoFactory();
    }

    public function validatePostParamsInProductInsertApi(array $paramsFields, \stdClass $stock): void
    {
        $this->validateFieldsExist($paramsFields, $stock);
        $this->validateItemValueMustNotExistsInDb(FieldsEnum::getBasicValidateFields(), $stock);
        $sizeBO = new SizeBO();
        if (!$sizeBO->countById($stock->sizeId)) {
            Response::RenderAttributeNotFound(FieldsEnum::SIZE_ID_JSON);
        }
        $colorBO = new ColorBO();
        if (!$colorBO->countById($stock->colorId)) {
            Response::RenderAttributeNotFound(FieldsEnum::COLOR_ID_JSON);
        }
        $brandBO = new BrandBO();
        if (!$brandBO->countById($stock->brandId)) {
            Response::RenderAttributeNotFound(FieldsEnum::BRAND_ID_JSON);
        }
    }

    public function insertMultipleStocks(array $stocks): void
    {
        foreach ($stocks as $stock) {
            $this->insert($stock);
        }
    }

    public function findByProductId(int $id): null|array
    {
        $stocks = $this->dao->findByProductId($id);
        $stocksFind = array();
        foreach ($stocks as $stock) {
            $stocksFind[] = $this->factory->populateDbToDto($stock);
        }
        return $stocksFind;
    }

    public function deleteStocksByProductId(int $id): void
    {
        $this->dao->deleteByProductId($id);
    }
}