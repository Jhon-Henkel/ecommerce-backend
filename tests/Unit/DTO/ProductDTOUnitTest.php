<?php

namespace Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\ProductDTO;

class ProductDTOUnitTest extends TestCase
{
    public object $product;

    protected function setUp(): void
    {
        $this->product = new ProductDTO();
    }

    public function testGetterAndSettersProduct()
    {
        $this->product->setId(321);
        $this->product->setCode('product-321');
        $this->product->setName('product 321');
        $this->product->setDescription('description product');
        $this->product->setCategoryId(963);
        $this->product->setStockId(258);
        $this->assertEquals(321, $this->product->getId());
        $this->assertEquals('product-321', $this->product->getCode());
        $this->assertEquals('product 321', $this->product->getName());
        $this->assertEquals('description product', $this->product->getDescription());
        $this->assertEquals(963, $this->product->getCategoryId());
        $this->assertEquals(258,$this->product->getStockId());
    }
}