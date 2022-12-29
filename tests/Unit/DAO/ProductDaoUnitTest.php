<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\ProductDAO;
use src\DTO\ProductDTO;
use tests\Traits\ProductTraits;

class ProductDaoUnitTest extends TestCase
{
    use ProductTraits;

    public ProductDAO $dao;
    public ProductDTO $item;

    protected function setUp(): void
    {
        $this->dao = new ProductDAO('test_table');
        $this->item = $this->makeDtoProductTest145();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $expected = 'product_code, product_name, product_url, product_description, product_category_id';
        $this->assertEquals($expected, $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $paramsString = $this->dao->getParamsStringToInsert();
        $this->assertEquals(':code, :name, :url, :description, :categoryId', $paramsString);
    }

    public function testGetParamsArrayToInsert()
    {
        $paramsArray = $this->dao->getParamsArrayToInsert($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals('Product Test', $paramsArray['name']);
        $this->assertEquals('product-test-145', $paramsArray['code']);
        $this->assertEquals('Description for product 145', $paramsArray['description']);
        $this->assertEquals('product-test-145/product-test', $paramsArray['url']);
        $this->assertEquals(105, $paramsArray['categoryId']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $expected = 'product_code = :code, product_name = :name, product_url = :url,';
        $expected .= ' product_description = :description, product_category_id = :categoryId';
        $this->assertEquals($expected, $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('product_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(145, $paramsArray['id']);
        $this->assertEquals('Product Test', $paramsArray['name']);
        $this->assertEquals('product-test-145', $paramsArray['code']);
        $this->assertEquals('Description for product 145', $paramsArray['description']);
        $this->assertEquals('product-test-145/product-test', $paramsArray['url']);
        $this->assertEquals(105, $paramsArray['categoryId']);
    }
}