<?php

namespace Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\ProductStockDTO;

class ProductStockDTOUnitTest extends TestCase
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
        $this->productStock->setBandId(963);
        $this->productStock->setColorId(658);
        $this->productStock->setQuantity(100);
        $this->productStock->setSizeId(147);
        $this->productStock->setPrice(147.50);
        $this->assertEquals(654, $this->productStock->getId());
        $this->assertEquals('stock-654', $this->productStock->getCode());
        $this->assertEquals(963, $this->productStock->getBandId());
        $this->assertEquals(658, $this->productStock->getColorId());
        $this->assertEquals(100, $this->productStock->getQuantity());
        $this->assertEquals(147.50, $this->productStock->getPrice());
    }
}