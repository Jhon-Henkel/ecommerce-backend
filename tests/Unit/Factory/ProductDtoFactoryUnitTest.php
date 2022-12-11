<?php

namespace tests\Unit\Factory;

use PHPUnit\Framework\TestCase;
use src\DTO\ProductDTO;
use src\Factory\ProductDtoFactory;

class ProductDtoFactoryUnitTest extends TestCase
{
    public \stdClass $stdProduct;
    public ProductDTO $dtoProduct;
    public array $dbProduct;
    public ProductDtoFactory $factory;

    protected function setUp(): void
    {
        $this->stdProduct = $this->makeStdProduct();
        $this->dtoProduct = $this->makeDtoProduct();
        $this->dbProduct = $this->makeArrayProductDb();
        $this->factory = new ProductDtoFactory();
    }

    public function testMakePublic()
    {
        $publicProduct = $this->factory->makePublic($this->dtoProduct);
        $this->assertInstanceOf(\stdClass::class, $publicProduct);
        $this->assertEquals(7896, $publicProduct->id);
        $this->assertEquals('Product for test', $publicProduct->name);
        $this->assertEquals('product-code-for-test', $publicProduct->code);
        $this->assertEquals(2, $publicProduct->categoryId);
        $this->assertEquals('description for product', $publicProduct->description);
        $this->assertEquals('url/test', $publicProduct->url);
    }

    public function testFactory()
    {
        $factored = $this->factory->factory($this->stdProduct);
        $this->assertInstanceOf(ProductDTO::class, $factored);
        $this->assertEquals(7896, $factored->getId());
        $this->assertEquals('Product for test', $factored->getName());
        $this->assertEquals('product-code-for-test', $factored->getCode());
        $this->assertEquals(2, $factored->getCategoryId());
        $this->assertEquals('description for product', $factored->getDescription());
        $this->assertEquals('url/test', $factored->getUrl());
    }

    public function testPopulateDbToDto()
    {
        $product = $this->factory->populateDbToDto($this->dbProduct);
        $this->assertInstanceOf(ProductDTO::class, $product);
        $this->assertEquals(7896, $product->getId());
        $this->assertEquals('Product for test', $product->getName());
        $this->assertEquals('product-code-for-test', $product->getCode());
        $this->assertEquals(2, $product->getCategoryId());
        $this->assertEquals('description for product', $product->getDescription());
        $this->assertEquals('url/test', $product->getUrl());
    }

    public function testFactoryUrl()
    {
        $item = $this->stdProduct;
        $item->url = null;
        $factored = $this->factory->factory($item);
        $this->assertEquals('product-code-for-test/product-for-test', $factored->getUrl());
    }

    public function testFactoryProductWithStockPublic()
    {
        $array = array('1' => '2', '3' => '4');
        $factored = $this->factory->factoryProductWithStockPublic($this->dtoProduct, $array);
        $this->assertInstanceOf(\stdClass::class, $factored);
        $this->assertIsArray($factored->stocks);
    }

    public function makeStdProduct(): \stdClass
    {
        $product = new \stdClass();
        $product->id = 7896;
        $product->name = 'Product for test';
        $product->code = 'product-code-for-test';
        $product->categoryId = 2;
        $product->description = 'description for product';
        $product->url = 'url/test';
        return $product;
    }

    public function makeDtoProduct(): ProductDTO
    {
        $product = new ProductDTO();
        $product->setId(7896);
        $product->setName('Product for test');
        $product->setCode('product-code-for-test');
        $product->setCategoryId(2);
        $product->setDescription('description for product');
        $product->setUrl('url/test');
        return $product;
    }

    public function makeArrayProductDb(): array
    {
        $item = array();
        $item['product_id'] = 7896;
        $item['product_name'] = 'Product for test';
        $item['product_code'] = 'product-code-for-test';
        $item['product_category_id'] = 2;
        $item['product_description'] = 'description for product';
        $item['product_url'] = 'url/test';
        return $item;
    }
}