<?php

namespace src\BO;

use src\Api\Response;
use src\DAO\ProductDAO;
use src\DTO\ProductDTO;
use src\Enums\FieldsEnum;
use src\Enums\TableEnum;
use src\Factory\ProductDtoFactory;

class ProductBO extends BasicBO
{
    public ProductDAO $dao;
    public ProductDtoFactory $factory;

    public function __construct()
    {
        $this->dao = new ProductDAO(TableEnum::PRODUCT);
        $this->factory = new ProductDtoFactory();
    }

    public function validatePostParamsApi(array $paramsFields, \stdClass $product): void
    {
        $this->validateFieldsExist($paramsFields, $product);
        $this->validateItemValueMustNotExistsInDb(FieldsEnum::getBasicRequiredFields(), $product);
        $categoryBO = new CategoryBO();
        if (!$categoryBO->countById($product->categoryId)) {
            Response::renderAttributeNotFound(FieldsEnum::CATEGORY_ID_JSON);
        }
    }

    public function validatePutParamsApi(array $paramsFields, \stdClass $product): void
    {
        if (!$this->dao->countByColumnValue(FieldsEnum::ID, $product->id)) {
            Response::renderNotFound();
        }
        $this->validateFieldsExist($paramsFields, $product);
        $categoryBO = new CategoryBO();
        if (!$categoryBO->countById($product->categoryId)) {
            Response::renderAttributeNotFound(FieldsEnum::CATEGORY_ID_JSON);
        }
        $this->validateItemValueMustNotExistsInDbExceptId(FieldsEnum::getBasicRequiredFields(), $product, $product->id);
    }

    public function validateStocksInInsert(array $stocks): void
    {
        $stockBO = new ProductStockBO();
        foreach ($stocks as $stock) {
            $stockBO->validatePostParamsInProductInsertApi(FieldsEnum::getProductStockRequiredFields(), $stock);
        }
    }

    public function factoryStocksToInsertInProduct(array $stocks, int $productId): array
    {
        $stockBO = new ProductStockBO();
        $stockFactored = array();
        foreach ($stocks as $stock) {
            $stock->productId = $productId;
            $stockFactored[] = $stockBO->factory->factory($stock);
        }
        return $stockFactored;
    }

    public function factoryProductWithStockPublic(ProductDTO $product, array $stocks): \stdClass
    {
        $stockBO = new ProductStockBO();
        $publicStocks = array();
        foreach ($stocks as $stock) {
            $publicStocks[] = $stockBO->factory->makePublic($stock);
        }
        return $this->factory->factoryProductWithStockPublic($product, $publicStocks);
    }

    public function findAll(): array
    {
        $stockBO = new ProductStockBO();
        $products = parent::findall();
        $productsWithStocks = array();
        foreach ($products as $product) {
            $stocks = $stockBO->findByProductId($product->id);
            $product = $this->factory->factory($product);
            $productsWithStocks[] = $this->factoryProductWithStockPublic($product, $stocks);
        }
        return $productsWithStocks;
    }

    public function findById(int $id): \stdClass|null
    {
        $product = parent::findById($id);
        if (!$product) {
            return null;
        }
        $stockBO = new ProductStockBO();
        $stock = $stockBO->findByProductId($id);
        return $this->factoryProductWithStockPublic($product, $stock);
    }

    public function deleteById(int $id): void
    {
        $stockBO = new ProductStockBO();
        $stockBO->deleteStocksByProductId($id);
        parent::deleteById($id);
    }
}