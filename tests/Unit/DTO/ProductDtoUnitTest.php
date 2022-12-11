<?php

namespace tests\Unit\DTO;

use PHPUnit\Framework\TestCase;
use src\DTO\ProductDTO;

class ProductDtoUnitTest extends TestCase
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
        $this->product->setUrl('product-321123');
        $this->product->setDescription('description product');
        $this->product->setCategoryId(963);
        $this->assertEquals(321, $this->product->getId());
        $this->assertEquals('product-321', $this->product->getCode());
        $this->assertEquals('product 321', $this->product->getName());
        $this->assertEquals('product-321123', $this->product->getUrl());
        $this->assertEquals('description product', $this->product->getDescription());
        $this->assertEquals(963, $this->product->getCategoryId());
    }
}