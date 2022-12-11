<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\ProductStockDTO;
use src\Factory\ProductStockDtoFactory;

class ProductStockDtoFactoryUnitTest extends TestCase
{
    public \stdClass $stdStock;
    public ProductStockDTO $dtoStock;
    public array $dbStock;
    public ProductStockDtoFactory $factory;

    protected function setUp(): void
    {
        $this->stdStock = $this->makeStdStock();
        $this->dtoStock = $this->makeDtoStock();
        $this->dbStock = $this->makeArrayStockDb();
        $this->factory = new ProductStockDtoFactory();
    }

    public function testMakePublic()
    {
        $publicStock = $this->factory->makePublic($this->dtoStock);
        $this->assertInstanceOf(\stdClass::class, $publicStock);
        $this->assertEquals(9654, $publicStock->id);
        $this->assertEquals('stock-9654', $publicStock->code);
        $this->assertEquals('Stock 9654', $publicStock->name);
        $this->assertEquals(100, $publicStock->quantity);
        $this->assertEquals(2, $publicStock->colorId);
        $this->assertEquals(3, $publicStock->sizeId);
        $this->assertEquals(5, $publicStock->brandId);
        $this->assertEquals(50, $publicStock->productId);
        $this->assertEquals(15, $publicStock->price);
        $this->assertEquals(200, $publicStock->width);
        $this->assertEquals(150, $publicStock->height);
        $this->assertEquals(65, $publicStock->length);
        $this->assertEquals(1500, $publicStock->grossWeight);
    }

    public function testFactory()
    {
        $factored = $this->factory->factory($this->stdStock);
        $this->assertInstanceOf(ProductStockDTO::class, $factored);
        $this->assertEquals(9654, $factored->getId());
        $this->assertEquals('stock-9654', $factored->getCode());
        $this->assertEquals('Stock 9654', $factored->getName());
        $this->assertEquals(100, $factored->getQuantity());
        $this->assertEquals(2, $factored->getColorId());
        $this->assertEquals(3, $factored->getSizeId());
        $this->assertEquals(5, $factored->getBandId());
        $this->assertEquals(50, $factored->getProductId());
        $this->assertEquals(15, $factored->getPrice());
        $this->assertEquals(200, $factored->getWidth());
        $this->assertEquals(150, $factored->getHeight());
        $this->assertEquals(65, $factored->getLength());
        $this->assertEquals(1500, $factored->getGrossWeight());
    }

    public function testPopulateDbToDto()
    {
        $stock = $this->factory->populateDbToDto($this->dbStock);
        $this->assertInstanceOf(ProductStockDTO::class, $stock);
        $this->assertEquals(9654, $stock->getId());
        $this->assertEquals('stock-9654', $stock->getCode());
        $this->assertEquals('Stock 9654', $stock->getName());
        $this->assertEquals(100, $stock->getQuantity());
        $this->assertEquals(2, $stock->getColorId());
        $this->assertEquals(3, $stock->getSizeId());
        $this->assertEquals(5, $stock->getBandId());
        $this->assertEquals(50, $stock->getProductId());
        $this->assertEquals(15.74, $stock->getPrice());
        $this->assertEquals(200, $stock->getWidth());
        $this->assertEquals(150, $stock->getHeight());
        $this->assertEquals(65, $stock->getLength());
        $this->assertEquals(1500, $stock->getGrossWeight());
    }

    public function makeStdStock(): \stdClass
    {
        $stockPublic = new \stdClass();
        $stockPublic->id = 9654;
        $stockPublic->code = 'stock-9654';
        $stockPublic->name = 'Stock 9654';
        $stockPublic->quantity = 100;
        $stockPublic->colorId = 2;
        $stockPublic->sizeId = 3;
        $stockPublic->brandId = 5;
        $stockPublic->productId = 50;
        $stockPublic->price = 15;
        $stockPublic->width = 200;
        $stockPublic->height = 150;
        $stockPublic->length = 65;
        $stockPublic->grossWeight = 1500;
        return $stockPublic;
    }

    public function makeDtoStock(): ProductStockDTO
    {
        $productStockDTO = new ProductStockDTO();
        $productStockDTO->setId(9654);
        $productStockDTO->setCode('stock-9654');
        $productStockDTO->setName('Stock 9654');
        $productStockDTO->setQuantity(100);
        $productStockDTO->setColorId(2);
        $productStockDTO->setSizeId(3);
        $productStockDTO->setBandId(5);
        $productStockDTO->setProductId(50);
        $productStockDTO->setPrice(15);
        $productStockDTO->setWidth(200);
        $productStockDTO->setHeight(150);
        $productStockDTO->setLength(65);
        $productStockDTO->setGrossWeight(1500);
        return $productStockDTO;
    }

    public function makeArrayStockDb(): array
    {
        $item = array();
        $item['product_stock_id'] = 9654;
        $item['product_stock_code'] = 'stock-9654';
        $item['product_stock_name'] = 'Stock 9654';
        $item['product_stock_quantity'] = 100;
        $item['product_stock_color_id'] = 2;
        $item['product_stock_size_id'] = 3;
        $item['product_stock_brand_id'] = 5;
        $item['product_stock_product_id'] = 50;
        $item['product_stock_price'] = 15.74;
        $item['product_stock_width'] = 200;
        $item['product_stock_height'] = 150;
        $item['product_stock_length'] = 65;
        $item['product_stock_gross_weight'] = 1500;
        return $item;
    }
}