<?php

namespace tests\Unit\Traits;

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
        $stock->setProductId(199);
        $stock->setPrice(10.50);
        $stock->setBandId(2);
        $stock->setColorId(65);
        $stock->setQuantity(1999);
        $stock->setSizeId(6);
        return $stock;
    }
}