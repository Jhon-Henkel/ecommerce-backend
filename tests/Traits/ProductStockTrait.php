<?php

namespace tests\Traits;

use src\DTO\ProductStockDTO;

trait ProductStockTrait
{
    public function makeDtoProductStockTest74(): ProductStockDTO
    {
        $stock = new ProductStockDTO();
        $stock->setId(74);
        $stock->setName('Stock Test');
        $stock->setCode('stock-test-74');
        $stock->setGrossWeight(1500);
        $stock->setLength(10);
        $stock->setHeight(5);
        $stock->setWidth(15);
        $stock->setProductId(145);
        $stock->setPrice(10.50);
        $stock->setBandId(99);
        $stock->setColorId(95);
        $stock->setQuantity(1999);
        $stock->setSizeId(12);
        return $stock;
    }

    public function makeDtoProductStockTest75(): ProductStockDTO
    {
        $stock = new ProductStockDTO();
        $stock->setId(75);
        $stock->setName('Stock Test 75');
        $stock->setCode('stock-test-75');
        $stock->setGrossWeight(500);
        $stock->setLength(100);
        $stock->setHeight(50);
        $stock->setWidth(150);
        $stock->setProductId(145);
        $stock->setPrice(100.59);
        $stock->setBandId(99);
        $stock->setColorId(95);
        $stock->setQuantity(8888);
        $stock->setSizeId(12);
        return $stock;
    }
}