<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\ProductStockDAO;
use src\DTO\ProductStockDTO;
use tests\Unit\Traits\ProductStockTrait;

class ProductStockDaoUnitTest extends TestCase
{
    use ProductStockTrait;

    public ProductStockDAO $dao;
    public ProductStockDTO $item;

    protected function setUp(): void
    {
        $this->dao = new ProductStockDAO('test_table');
        $this->item = $this->makeDtoProductStockTest74();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $expected = 'product_stock_code, product_stock_name, product_stock_quantity, product_stock_color_id,';
        $expected .= ' product_stock_size_id, product_stock_brand_id, product_stock_product_id, product_stock_price,';
        $expected .= 'product_stock_width, product_stock_height, product_stock_length, product_stock_gross_weight';
        $this->assertEquals($expected, $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $paramsString = $this->dao->getParamsStringToInsert();
        $expected = ':code, :name, :quantity, :color_id, :size_id, :brand_id,';
        $expected .= ' :product_id, :price, :width, :height, :length, :gross_weight';
        $this->assertEquals($expected, $paramsString);
    }

    public function testGetParamsArrayToInsert()
    {
        $paramsArray = $this->dao->getParamsArrayToInsert($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals('stock-test-74', $paramsArray['code']);
        $this->assertEquals('Stock Test', $paramsArray['name']);
        $this->assertEquals(1999, $paramsArray['quantity']);
        $this->assertEquals(65, $paramsArray['color_id']);
        $this->assertEquals(6, $paramsArray['size_id']);
        $this->assertEquals(2, $paramsArray['brand_id']);
        $this->assertEquals(199, $paramsArray['product_id']);
        $this->assertEquals(10.50, $paramsArray['price']);
        $this->assertEquals(15, $paramsArray['width']);
        $this->assertEquals(5, $paramsArray['height']);
        $this->assertEquals(10, $paramsArray['length']);
        $this->assertEquals(1500, $paramsArray['gross_weight']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $expected = 'product_stock_code = :product_id, product_stock_name = :name,';
        $expected .= ' product_stock_quantity = :quantity, product_stock_color_id = :color_id,';
        $expected .= ' product_stock_size_id = :size_id, product_stock_brand_id = :brand_id,';
        $expected .= ' product_stock_product_id = :product_id, product_stock_price = :price,';
        $expected .= ' product_stock_width = :width, product_stock_height = :height,';
        $expected .= ' product_stock_length = :length, product_stock_gross_weight = :gross_weight';
        $this->assertEquals($expected, $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('product_stock_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(74, $paramsArray['id']);
        $this->assertEquals('stock-test-74', $paramsArray['code']);
        $this->assertEquals('Stock Test', $paramsArray['name']);
        $this->assertEquals(1999, $paramsArray['quantity']);
        $this->assertEquals(65, $paramsArray['color_id']);
        $this->assertEquals(6, $paramsArray['size_id']);
        $this->assertEquals(2, $paramsArray['brand_id']);
        $this->assertEquals(199, $paramsArray['product_id']);
        $this->assertEquals(10.50, $paramsArray['price']);
        $this->assertEquals(15, $paramsArray['width']);
        $this->assertEquals(5, $paramsArray['height']);
        $this->assertEquals(10, $paramsArray['length']);
        $this->assertEquals(1500, $paramsArray['gross_weight']);
    }
}