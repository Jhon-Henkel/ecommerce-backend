<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\ColorDAO;
use src\DTO\ColorDTO;
use tests\Unit\Traits\ColorTraits;

class ColorDaoUnitTest extends TestCase
{
    use ColorTraits;

    public ColorDAO $dao;
    public ColorDTO $item;

    protected function setUp(): void
    {
        $this->dao = new ColorDAO('test_table');
        $this->item = $this->makeDtoColorTest95();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $this->assertEquals('color_code, color_name', $columns);
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
        $this->assertEquals('Color Test', $paramsArray['name']);
        $this->assertEquals('color-test-95', $paramsArray['code']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $this->assertEquals('color_code = :code, color_name = :name', $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('color_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(95, $paramsArray['id']);
        $this->assertEquals('Color Test', $paramsArray['name']);
        $this->assertEquals('color-test-95', $paramsArray['code']);
    }
}