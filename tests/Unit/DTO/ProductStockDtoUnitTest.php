<?php

namespace tests\Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\ProductStockDTO;

class ProductStockDtoUnitTest extends TestCase
{
    public object $productStock;

    protected function setUp(): void
    {
        $this->productStock = new ProductStockDTO();
    }

    public function testGetterAndSettersProductStock()
    {
        $this->productStock->setId(654);
        $this->productStock->setCode('stock-654');
        $this->productStock->setName('Stock 654');
        $this->productStock->setBandId(963);
        $this->productStock->setColorId(658);
        $this->productStock->setSizeId(147);
        $this->productStock->setProductId(19);
        $this->productStock->setQuantity(100);
        $this->productStock->setPrice(147.50);
        $this->productStock->setWidth(10);
        $this->productStock->setHeight(150);
        $this->productStock->setLength(50);
        $this->productStock->setGrossWeight(80);
        $this->assertEquals(654, $this->productStock->getId());
        $this->assertEquals('stock-654', $this->productStock->getCode());
        $this->assertEquals('Stock 654', $this->productStock->getName());
        $this->assertEquals(963, $this->productStock->getBandId());
        $this->assertEquals(658, $this->productStock->getColorId());
        $this->assertEquals(147, $this->productStock->getSizeId());
        $this->assertEquals(19, $this->productStock->getProductId());
        $this->assertEquals(100, $this->productStock->getQuantity());
        $this->assertEquals(147.50, $this->productStock->getPrice());
        $this->assertEquals(10, $this->productStock->getWidth());
        $this->assertEquals(150, $this->productStock->getHeight());
        $this->assertEquals(50, $this->productStock->getLength());
        $this->assertEquals(80, $this->productStock->getGrossWeight());
    }
}