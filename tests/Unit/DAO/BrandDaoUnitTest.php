<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\BrandDAO;
use src\DTO\BrandDTO;
use tests\Traits\BrandTraits;

class BrandDaoUnitTest extends TestCase
{
    use BrandTraits;

    public BrandDAO $dao;
    public BrandDTO $item;

    protected function setUp(): void
    {
        $this->dao = new BrandDAO('test_table');
        $this->item = $this->makeDtoBrandTest99();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $this->assertEquals('brand_code, brand_name', $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $paramsString = $this->dao->getParamsStringToInsert();
        $this->assertEquals(':code, :name', $paramsString);
    }

    public function testGetParamsArrayToInsert()
    {
        $paramsArray = $this->dao->getParamsArrayToInsert($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals('Brand Test', $paramsArray['name']);
        $this->assertEquals('brand-test-99', $paramsArray['code']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $this->assertEquals('brand_code = :code, brand_name = :name', $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('brand_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(99, $paramsArray['id']);
        $this->assertEquals('Brand Test', $paramsArray['name']);
        $this->assertEquals('brand-test-99', $paramsArray['code']);
    }
}