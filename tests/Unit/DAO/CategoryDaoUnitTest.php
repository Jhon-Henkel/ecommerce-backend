<?php

namespace tests\Unit\DAO;

use PHPUnit\Framework\TestCase;
use src\DAO\CategoryDAO;
use src\DTO\CategoryDTO;
use tests\Traits\CategoryTraits;

class CategoryDaoUnitTest extends TestCase
{
    use CategoryTraits;

    public CategoryDAO $dao;
    public CategoryDTO $item;

    protected function setUp(): void
    {
        $this->dao = new CategoryDAO('test_table');
        $this->item = $this->makeDtoCategoryTest105();
    }

    public function testGetColumnsToInsert()
    {
        $columns = $this->dao->getColumnsToInsert();
        $this->assertEquals('category_code, category_name, category_father_id', $columns);
    }

    public function testGetParamsStringToInsert()
    {
        $paramsString = $this->dao->getParamsStringToInsert();
        $this->assertEquals(':code, :name, :fatherId', $paramsString);
    }

    public function testGetParamsArrayToInsert()
    {
        $paramsArray = $this->dao->getParamsArrayToInsert($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals('Category Test', $paramsArray['name']);
        $this->assertEquals('category-test-105', $paramsArray['code']);
        $this->assertEquals(10, $paramsArray['fatherId']);
    }

    public function testGetUpdateSting()
    {
        $updateString = $this->dao->getUpdateSting();
        $expect = 'category_code = :code, category_name = :name, category_father_id = :fatherId';
        $this->assertEquals($expect, $updateString);
    }

    public function testGetWhereClausuleToUpdate()
    {
        $where = $this->dao->getWhereClausuleToUpdate();
        $this->assertEquals('category_id = :id', $where);
    }

    public function testGetParamsArrayToUpdate()
    {
        $paramsArray = $this->dao->getParamsArrayToUpdate($this->item);
        $this->assertIsArray($paramsArray);
        $this->assertEquals(105, $paramsArray['id']);
        $this->assertEquals('Category Test', $paramsArray['name']);
        $this->assertEquals('category-test-105', $paramsArray['code']);
        $this->assertEquals(10, $paramsArray['fatherId']);
    }
}