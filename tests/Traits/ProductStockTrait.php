<?php

namespace tests\Traits;

use src\DTO\ProductStockDTO;
use stdClass;

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

    public function makeStdStock100(): stdClass
    {
        $item = new stdClass();
        $item->code = "stock-100";
        $item->name = "Stock Teste 100";
        $item->quantity = 15;
        $item->colorId = 94;
        $item->sizeId = 11;
        $item->brandId = 98;
        $item->price = 2;
        $item->width = 18;
        $item->height = 159;
        $item->length = 36;
        $item->grossWeight = 1600;
        return $item;
    }

    public function makeStdStock101(): stdClass
    {
        $item = new stdClass();
        $item->code = "stock-101";
        $item->name = "Stock Teste 101";
        $item->quantity = 1255;
        $item->colorId = 95;
        $item->sizeId = 12;
        $item->brandId = 99;
        $item->price = 15.45;
        $item->width = 150;
        $item->height = 57;
        $item->length = 2;
        $item->grossWeight = 200;
        return $item;
    }

    public function makeStdStock102(): stdClass
    {
        $item = new stdClass();
        $item->code = "stock-102";
        $item->name = "Stock Teste 102";
        $item->quantity = 999;
        $item->colorId = 95;
        $item->sizeId = 12;
        $item->brandId = 99;
        $item->price = 25.22;
        $item->width = 150;
        $item->height = 57;
        $item->length = 2;
        $item->grossWeight = 200;
        return $item;
    }
}