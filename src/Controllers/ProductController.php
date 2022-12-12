<?php

namespace src\Controllers;

use src\Api\Response;
use src\BO\ProductBO;
use src\BO\ProductStockBO;
use src\Enums\FieldsEnum;
use src\Enums\HttpStatusCodeEnum;
use src\Factory\ProductDtoFactory;

class ProductController extends BasicController
{
    public ProductBO $bo;
    public ProductDtoFactory $factory;
    public array $fieldsToValidate;

    public function __construct()
    {
        $this->bo = new ProductBO();
        $this->factory = new ProductDtoFactory();
        $this->fieldsToValidate = FieldsEnum::getProductAllFields();
    }

    public function apiPost(\stdClass $product)
    {
        $stockBO = new ProductStockBO();
        $this->bo->validatePostParamsApi($this->fieldsToValidate, $product);
        $this->bo->validateStocksInInsert($product->stock);
        $productToInsert = $this->factory->factory($product);
        $this->bo->insert($productToInsert);
        $productInserted = $this->bo->findLastInserted();
        $stocksToInsert = $this->bo->factoryStocksToInsertInProduct($product->stock, $productInserted->getId());
        $stockBO->insertMultipleStocks($stocksToInsert);
        $stocksInserted = $stockBO->findByProductId($productInserted->getId());
        $productInsertedWithStock = $this->bo->factoryProductWithStockPublic($productInserted, $stocksInserted);
        Response::render(HttpStatusCodeEnum::HTTP_CREATED, $productInsertedWithStock);
    }

    public function apiGet(int $id)
    {
        $product = $this->bo->findById($id);
        if (!$product){
            Response::renderNotFound();
        }
        Response::render(HttpStatusCodeEnum::HTTP_OK, $product);
    }

    public function apiIndex()
    {
        Response::render(HttpStatusCodeEnum::HTTP_OK, $this->bo->findAll());
    }
}