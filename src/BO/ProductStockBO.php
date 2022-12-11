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
        $this->validationsAttributesIdsExistsForApi($stock);
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $item): void
    {
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateProductExistsForApiById($item->productId);
        $this->validationsAttributesIdsExistsForApi($item);
        parent::validatePostParamsApi(FieldsEnum::getBasicValidateFields(), $item);
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $item): void
    {
        $this->validateFieldsExist($paramsFields, $item);
        $this->validateProductExistsForApiById($item->productId);
        $this->validationsAttributesIdsExistsForApi($item);
        parent::validatePutParamsApi(FieldsEnum::getBasicValidateFields(), $item);
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

    public function validationsAttributesIdsExistsForApi(\stdClass $item): void
    {
        $this->validateColorExistsForApiById($item->colorId);
        $this->validateSizeExistsForApiById($item->sizeId);
        $this->validateBrandExistsForApiById($item->brandId);
    }

    public function validateProductExistsForApiById(int $id): void
    {
        if (!$this->dao->countByColumnValue(FieldsEnum::PRODUCT_ID_DB, $id)) {
            Response::RenderAttributeNotFound(FieldsEnum::PRODUCT_ID_JSON);
        }
    }

    public function validateColorExistsForApiById(int $id): void
    {
        $colorBO = new ColorBO();
        if (!$colorBO->countById($id)) {
            Response::RenderAttributeNotFound(FieldsEnum::COLOR_ID_JSON);
        }
    }

    public function validateSizeExistsForApiById(int $id): void
    {
        $sizeBO = new SizeBO();
        if (!$sizeBO->countById($id)) {
            Response::RenderAttributeNotFound(FieldsEnum::SIZE_ID_JSON);
        }
    }

    public function validateBrandExistsForApiById(int $id): void
    {
        $brandBO = new BrandBO();
        if (!$brandBO->countById($id)) {
            Response::RenderAttributeNotFound(FieldsEnum::BRAND_ID_JSON);
        }
    }
}