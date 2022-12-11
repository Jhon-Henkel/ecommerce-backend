<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\SizeDAO;
use src\DTO\SizeDTO;
use tests\Unit\Traits\SizeTraits;

class SizeDaoUnitTest extends TestCase
{
    use SizeTraits;

    public SizeDAO $dao;
    public SizeDTO $item;

    protected function setUp(): void
    {
        $this->dao = new SizeDAO('test_table');
        $this->item = $this->makeDtoSizeTest12();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $this->assertEquals('size_code, size_name', $columns);
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
        $this->assertEquals('Size Test', $paramsArray['name']);
        $this->assertEquals('size-test-12', $paramsArray['code']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $this->assertEquals('size_code = :code, size_name = :name', $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('size_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(12, $paramsArray['id']);
        $this->assertEquals('Size Test', $paramsArray['name']);
        $this->assertEquals('size-test-12', $paramsArray['code']);
    }
}